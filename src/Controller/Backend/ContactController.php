<?php


namespace App\Controller\Backend;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/contacts')]
class ContactController extends AbstractController
{
    public function __construct(
        private readonly ContactRepository $contactRepository
    ) {
    }

    #[Route('', name: 'app.admin.contacts.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Backend/Contact/index.html.twig', [
            'contacts' => $this->contactRepository->findByDate(),
        ]);
    }

    #[Route('/{id}/show', name: 'app.admin.contacts.show', methods: ['GET'])]
    public function show(Contact $contact): Response
    {
        if (!$contact instanceof Contact) {
            $this->addFlash('error', 'Pas de demande trouvée');

            return $this->redirectToRoute('app.admin.contacts.index');
        }

        return $this->render('Backend/Contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }
}
