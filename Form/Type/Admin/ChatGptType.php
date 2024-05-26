<?php

/*
 * This file is part of ChatGpt
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ChatGpt\Form\Type\Admin;

use Plugin\ChatGpt\Entity\ChatGpt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatGptType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('apiKey', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'APIキーを入力してください。',
                ],
            ])
            ->add('model', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'MODELを入力してください。例：gpt-3.5.turbo',
                ],
            ])
            ->add('product', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'placeholder' => '商品説明をChatGPTに書き換えてほしい指示内容を書いてください。',
                ],
            ])
            ->add('news', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'placeholder' => '商品説明をChatGPTに書き換えてほしい指示内容を書いてください。',
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ChatGpt::class,
        ]);
    }
}
