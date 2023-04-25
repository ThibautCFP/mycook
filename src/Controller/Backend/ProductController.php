<?php

namespace App\Controller\Backend;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin/products')]
class ProductController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {
    }

    #[Route('', name: 'app.admin.products.index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('Backend/Products/index.html.twig', [
            'products' => $this->productRepository->findAll(),
        ]);
    }


    #[Route('/create', name: 'app.admin.products.create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response|RedirectResponse
    {
        $product = new Product;

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productRepository->save($product, true);

            $this->addFlash('success', 'Produit créé avec succès');

            return $this->redirectToRoute('app.admin.products.index');
        }

        return $this->render('Backend/Products/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/update/{slug}', name: 'app.admin.products.update', methods: ['GET', 'POST'])]
    public function update(Product $product, Request $request): Response|RedirectResponse
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productRepository->save($product, true);
            $this->addFlash('success', 'Produit modifié avec succès');

            return $this->redirectToRoute('app.admin.products.index');
        }

        return $this->render('Backend/Products/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{slug}', name: 'app.admin.products.delete', methods: ['DELETE', 'GET', 'POST'])]
    public function delete(Product $product, Request $request): Response|RedirectResponse
    {
        if (!$product instanceof Product) {
            $this->addFlash('error', 'Produit non trouvé');
            return $this->redirectToRoute('app.admin.products.index');
        }

        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->get('_token'))) {
            $this->productRepository->remove($product, true);
            $this->addFlash('success', 'Produit supprimé avec succès');

            return $this->redirectToRoute('app.admin.products.index');
        }

        $this->addFlash('error', 'Le token n\'est pas valide');

        return $this->redirectToRoute('app.admin.products.index');
    }
}
