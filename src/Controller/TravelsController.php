<?php

namespace App\Controller;

use App\Entity\Travels;
use App\Form\TravelsType;
use App\Repository\TravelsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/travels')]
class TravelsController extends AbstractController
{
    #[Route('/', name: 'app_travels_index', methods: ['GET'])]
    public function index(TravelsRepository $travelsRepository): Response
    {
        return $this->render('travels/index.html.twig', [
            'travels' => $travelsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_travels_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $travel = new Travels();
        $form = $this->createForm(TravelsType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $now = new \DateTimeImmutable();
            $travel->setCreatedAt($now);
            $entityManager->persist($travel);
            $entityManager->flush();

            return $this->redirectToRoute('app_travels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('travels/new.html.twig', [
            'travel' => $travel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_travels_show', methods: ['GET'])]
    public function show(Travels $travel): Response
    {
        return $this->render('travels/show.html.twig', [
            'travel' => $travel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_travels_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Travels $travel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TravelsType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_travels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('travels/edit.html.twig', [
            'travel' => $travel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_travels_delete', methods: ['POST'])]
    public function delete(Request $request, Travels $travel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $travel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($travel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_travels_index', [], Response::HTTP_SEE_OTHER);
    }
}
