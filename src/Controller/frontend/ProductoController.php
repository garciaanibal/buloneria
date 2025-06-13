<?php

namespace App\Controller\frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductoController extends AbstractController
{
    #[Route('/productos', name: 'app_producto')]
    public function index(): Response
    {
        return $this->render('producto/list_products.html.twig', [
            'controller_name' => 'ProductoController',
        ]);
    }
}
