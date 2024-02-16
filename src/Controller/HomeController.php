<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Získání všech produktů z databáze
        $products = $entityManager->getRepository(Product::class)->findAll();

        // Předání dat do Twig šablony
        return $this->render('home.html.twig', [
            'products' => $products,
        ]);
    }
}
