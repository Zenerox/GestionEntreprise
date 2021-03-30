<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{
    #[Route('/stock', name: 'app_list_stock')]
    public function index(): Response
    {
        return $this->render('stock/list.html.twig', [
            'controller_name' => 'StockController',
        ]);
    }
}
