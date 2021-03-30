<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/client')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_list_client')]
    public function index(): Response
    {
        return $this->render('client/list.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/create', name:'app_create_client')]
    Public function create(Request $request, EntityManagerInterface $em): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()){
            // si le formulaire envoyé est valide, on crée le nouveau client
            $em->persist($client);
            $em->flush();

            $this->addFlash('success','Client créé avec succès');

            $this->redirectToRoute('app_list_client');
        }

        return $this->render('client/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
