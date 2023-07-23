<?php

namespace Plugin\ChatGpt\Form\Type\Admin;

use Plugin\ChatGpt\Entity\ChatGpt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatGptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apiKey', TextType::class, [
                'required' => true,
            ])
            ->add('model', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'gpt-3.5.turbo',
                ],
            ])
            ->add('product', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5,
                ],
            ])
            ->add('news', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChatGpt::class
        ]);
    }
}
