<?php

namespace App\Controller;

use App\Entity\Post;
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

    #[Route('/post/store', methods: ['POST'], name: 'app_post_store')]
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

    #[Route('/post/{id}/edit', methods: ['GET'], name: 'app_post_edit')]
    public function edit(Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);

        return $this->render('post/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $post->getId()
        ]);
    }

    #[Route('/post/{id}/update', methods: ['POST'], name: 'app_post_update')]
    public function update(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Post edited!');
        }

        return $this->redirectToRoute('app_post_edit', [
            'id' => $post->getId()
        ]);
    }
}
