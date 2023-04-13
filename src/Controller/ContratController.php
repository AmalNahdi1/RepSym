<?php

namespace App\Controller;

use App\Entity\Abonnement;
use App\Entity\Contrat;
use App\Entity\Message;
use App\Form\AbonnementsType;
use App\Form\ContratType;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contrat')]
class ContratController extends AbstractController
{
    #[Route('/', name: 'contrat_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ab = $entityManager
            ->getRepository(Contrat::class)
            ->findAll();


        return $this->render(
            'contrat/index.html.twig',
            [
                'ab' => $ab,
            ]
        );
    }

    #[Route('/add', name: 'contrat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Contrat();
        $form = $this->createForm(ContratType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('contrat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contrat/add.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'contrat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contrat $ab, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContratType::class, $ab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('contrat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contrat/edit.html.twig', [
            'ab' => $ab,
            'form' => $form,
        ]);
    }

    /*#[Route('/{id}/delete', name: 'contrat_delete', methods: ['GET'])]
    public function delete(Request $request, Contrat $message, EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($message);
        $entityManager->flush();


        return $this->redirectToRoute('contrat_index', [], Response::HTTP_SEE_OTHER);
    }*/








    #[Route('/all', name: 'contrat_all', methods: ['GET'])]
    public function indexFront(EntityManagerInterface $entityManager): Response
    {
        $ab = $entityManager
            ->getRepository(Contrat::class)
            ->findAll();


        return $this->render(
            'contrat/indexfront.html.twig',
            [
                'ab' => $ab,
            ]
        );
    }

    #[Route('/create', name: 'contrat_create', methods: ['GET', 'POST'])]
    public function newFront(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Contrat();
        $form = $this->createForm(ContratType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirectToRoute('contrat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contrat/addfront.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'contrat_update', methods: ['GET', 'POST'])]
    public function editfront(Request $request, Contrat $ab, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContratType::class, $ab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('contrat_all', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contrat/editfront.html.twig', [
            'ab' => $ab,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'contrat_delete', methods: ['GET'])]
    public function deleteFront(Request $request, Contrat $message, EntityManagerInterface $entityManager): Response
    {

        $entityManager->remove($message);
        $entityManager->flush();


        return $this->redirectToRoute('contrat_index', [], Response::HTTP_SEE_OTHER);
    }
}
