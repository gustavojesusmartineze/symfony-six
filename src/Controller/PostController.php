<?php

namespace App\Controller;

use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/create', name: 'app_post_create')]
    public function create(): Response
    {
        $form = $this->createForm(PostType::class);

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/post/store', methods: 'POST', name: 'app_post_store')]
    public function store(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Post created!');
        }

        return $this->redirectToRoute('app_post_create');
    }
}
