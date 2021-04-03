<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/rdv')]
class RdvController extends AbstractController
{
    #[Route('/planning', name: 'app_planning_rdv')]
    public function planning(): Response
    {
        return $this->render('rdv/planning.html.twig', [
            'controller_name' => 'RdvController',
        ]);
    }

}
