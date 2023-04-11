<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
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
