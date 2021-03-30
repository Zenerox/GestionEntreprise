<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RdvController extends AbstractController
{
    #[Route('/rdv', name: 'app_list_rdv')]
    public function index(): Response
    {
        return $this->render('rdv/list.html.twig', [
            'controller_name' => 'RdvController',
        ]);
    }
}
