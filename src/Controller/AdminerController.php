<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminerController extends AbstractController
{
    #[Route('/adminer', name: 'adminer')]
    public function index(): Response
    {
        return $this->render('./adminer/index.html.twig');
    }
}