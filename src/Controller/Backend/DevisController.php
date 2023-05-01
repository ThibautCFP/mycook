<?php

namespace App\Controller\Backend;

use App\Entity\Devis;
use App\Repository\DevisRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/admin/devis')]
class DevisController extends AbstractController
{
    public function __construct(
        private readonly DevisRepository $devisRepository,
    ) {
    }

    #[Route('', name: 'app.admin.devis.index', methods: ['GEt'])]
    public function index(): Response
    {
        return $this->render('Backend/Devis/index.html.twig', [
            'devis' => $this->devisRepository->findByDate(),
        ]);
    }

    #[Route('/{id}/show', name: 'app.admin.devis.show', methods: ['GET'])]
    public function show(Devis $devis): Response
    {
        return $this->render('Backend/Devis/show.html.twig', [
            'devis' => $devis,
        ]);
    }
}
