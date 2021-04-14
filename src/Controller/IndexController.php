<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\RdvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(RdvRepository $rdvRepo, ClientRepository $clientRepo): Response
    {
        $rdvList = $rdvRepo->findAll();

        $rdvs = [];
        foreach ($rdvList as $rdv){
            $client = $clientRepo->find($rdv->getClient());
            $rdvs[] = [
                'id' => $rdv->getId(),
                'title' => $client->getIdentity(),
                'start' => date_format($rdv->getDateDebut(), 'Y-m-d H:i:s'),
                'end' => date_format($rdv->getDateFin(), 'Y-m-d H:i:s')
            ];
        }

        $data = json_encode($rdvs);
        return $this->render('index.html.twig', compact('data'));
    }
}
