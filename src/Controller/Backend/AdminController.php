<?php

namespace App\Controller\Backend;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin')]
    public function index(): Response
    {
        return $this->render('Backend/Admin/index.html.twig');
    }
}
