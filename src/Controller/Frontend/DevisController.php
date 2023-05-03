<?php

namespace App\Controller\Frontend;

use App\Entity\Devis;
use App\Form\DevisType;
use App\Repository\DevisRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/devis')]
class DevisController extends AbstractController
{
    public function __construct(
        private readonly DevisRepository $devisRepository
    ) {
    }
    #[Route('', name: 'app.devis.create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response|RedirectResponse
    {
        $devis = new Devis;

        $form = $this->createForm(DevisType::class, $devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->devisRepository->save($devis, true);

            $this->addFlash('success', 'Le devis a été enregistré avec succès. Une réponse vous sera apporté dans un délais de 48h');

            return $this->redirectToRoute('app.home');
        }

        return $this->render('Frontend/Devis/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
