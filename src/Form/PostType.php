<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', ChoiceType::class, [
                'choices' => [
                    // 'PHP' => 'php',
                    // 'Laravel' => 'laravel',
                    // 'Symfony' => 'symfony'
                    'Languages' => [
                        'PHP' => 'php',
                        'Javascript' => 'javascript',
                    ],
                    'Frameworks' => [
                        'Laravel' => 'laravel',
                        'Symfony' => 'symfony',
                        'React' => 'react',
                        'Angular' => 'angular'
                    ]
                ],
                'placeholder' => 'Select one...',
                'label' => 'Categories'
            ])
            ->add('title', TextType::class, [
                'label' => 'Post Title',
                'help' => 'Think about how SEO will find you'
            ])
            ->add('body', TextareaType::class, [
                'label' => 'Post Body',
                'attr' => ['rows' => 9, 'class' => 'bg-light']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Send',
                'attr' => ['class' => 'btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            // 'csrf_protection' => false,
            // 'csrf_field_name' => 'token_personalized'
        ]);
    }
}
