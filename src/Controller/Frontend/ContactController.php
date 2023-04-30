<?php

namespace App\Controller\Frontend;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
class ContactController extends AbstractController
{
    public function __construct(
        private readonly ContactRepository $contactRepository,
    ) {
    }

    #[Route('', name: 'app.contact.index', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();
        /**
         * @var User $user
         */
        return $this->render('Frontend/Contact/index.html.twig', [
            'contacts' => $user ? $this->contactRepository->findById($user->getId()) : '',
        ]);
    }

    #[Route('/create', name: 'app.contact.create', methods: ['POST', 'GET'])]
    public function create(Request $request): Response|RedirectResponse
    {
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var User $user
             */
            $user = $this->getUser();
            if ($user) {
                $contact->setAuthor($user);
            }
            $this->contactRepository->save($contact, true);

            $this->addFlash('success', 'Votre demande est envoyée et sera traitée sous 48h');

            return $this->redirectToRoute('app.contact.index');
        }

        return $this->render('Frontend/Contact/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
