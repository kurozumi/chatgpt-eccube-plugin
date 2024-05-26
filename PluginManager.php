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

namespace Plugin\ChatGpt;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\ChatGpt\Entity\ChatGpt;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class PluginManager extends AbstractPluginManager
{
    /**
     * @param array $meta
     * @param ContainerInterface $container
     *
     * @return void
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function enable(array $meta, ContainerInterface $container): void
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $chatGpt = $entityManager->find(ChatGpt::class, ChatGpt::ID);
        if (null === $chatGpt) {
            $chatGpt = new ChatGpt();
            $chatGpt->setModel('gpt-3.5-turbo');
            $entityManager->persist($chatGpt);
            $entityManager->flush();
        }
    }
}
