<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvType;
use App\Repository\ClientRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rdv')]
class RdvController extends AbstractController
{
    #[Route('/{id<[0-9]+>}/create', name: 'app_create_rdv')]
    public function create(Request $request, ClientRepository $repo, EntityManagerInterface $em): Response
    {
        $client_id = $request->get('id');
        $client = $repo->find($client_id);

        $form = $this->createForm(RdvType::class);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){

            $rdvData = $request->request->get('rdv');
            $client = $repo->find($request->request->get('client'));

            $date = $rdvData['date'];
            $heureDebut = $rdvData['heureDebut'];
            $heureFin = $rdvData['heureFin'];

            $rdv = new Rdv();

            /* Date + heure de début */
            $heureDebutMinute = $heureDebut['minute'];
            $heureDebutMinute = ($heureDebutMinute == '0')?'00':$heureDebutMinute;

            $dateDebut = $date.' '.$heureDebut['hour'].':'.$heureDebutMinute.':00';
            $dateHeureDebut = DateTime::createFromFormat('Y-m-d H:i:s', $dateDebut);

            /* Date + heure de fin */
            $heureFinMinute = $heureDebut['minute'];
            $heureFinMinute = ($heureFinMinute == '0')?'00':$heureFinMinute;

            $dateFin = $date.' '.$heureFin['hour'].':'.$heureFinMinute.':00';
            $dateHeureFin = DateTime::createFromFormat('Y-m-d H:i:s', $dateFin);

            $rdv->setClient($client);
            $rdv->setDateDebut($dateHeureDebut);
            $rdv->setDateFin($dateHeureFin);

            // si le formulaire envoyé est valide, on crée le nouveau rdv
            $em->persist($rdv);
            $em->flush();

            $this->addFlash('success','Rdv créé avec succès');

            return $this->redirectToRoute('app_list_client');
        }
        return $this->render('rdv/create.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

}
