<?php

namespace App\Controller\Frontend;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    #[Route('', name: 'app.home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Frontend/home.html.twig');
    }
}
