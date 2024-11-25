<?php

namespace App\Controller;

use App\Entity\QuantiteCommande;
use App\Form\QuantiteCommandeType;
use App\Repository\QuantiteCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/quantite/commande')]
final class QuantiteCommandeController extends AbstractController
{
    #[Route(name: 'app_quantite_commande_index', methods: ['GET'])]
    public function index(QuantiteCommandeRepository $quantiteCommandeRepository): Response
    {
        return $this->render('quantite_commande/index.html.twig', [
            'quantite_commandes' => $quantiteCommandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_quantite_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quantiteCommande = new QuantiteCommande();
        $form = $this->createForm(QuantiteCommandeType::class, $quantiteCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quantiteCommande);
            $entityManager->flush();

            return $this->redirectToRoute('app_quantite_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quantite_commande/new.html.twig', [
            'quantite_commande' => $quantiteCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quantite_commande_show', methods: ['GET'])]
    public function show(QuantiteCommande $quantiteCommande): Response
    {
        return $this->render('quantite_commande/show.html.twig', [
            'quantite_commande' => $quantiteCommande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_quantite_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, QuantiteCommande $quantiteCommande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuantiteCommandeType::class, $quantiteCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quantite_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quantite_commande/edit.html.twig', [
            'quantite_commande' => $quantiteCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_quantite_commande_delete', methods: ['POST'])]
    public function delete(Request $request, QuantiteCommande $quantiteCommande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quantiteCommande->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($quantiteCommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quantite_commande_index', [], Response::HTTP_SEE_OTHER);
    }
}
