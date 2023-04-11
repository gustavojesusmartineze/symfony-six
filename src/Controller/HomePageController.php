<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    #[Route('/contact-v1', methods:['GET', 'POST'], name: 'contactV1')]
    public function ContactV1(Request $request): Response
    {
        $form = $this->createFormBUilder()
            ->add('email', TextType::class)
            ->add('message', TextareaType::class, [
                'label' => 'Comment, suggestion or message'
            ])
            ->add('agreeTerms', CheckboxType::class, ['priority' => 1,])
            ->add('save', SubmitType::class, [
                'label' => 'Send'
            ])
            // ->setMethod('GET')
            // ->setAction('other-url')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // getData() contains every value sent
            dd($form->getData(), $request);
        }

        return $this->render('home_page/contact-v1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact-v2', methods:['GET', 'POST'], name: 'contactV2')]
    public function ContactV2(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }

        return $this->render('home_page/contact-v2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact-v3', methods:['GET', 'POST'], name: 'contactV3')]
    public function ContactV3(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }

        return $this->render('home_page/contact-v3.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
