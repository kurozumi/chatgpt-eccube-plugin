<?php

/**
 * This file is part of ChatGpt
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 *  https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ChatGpt;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Plugin\AbstractPluginManager;
use Plugin\ChatGpt\Entity\ChatGpt;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginManager extends AbstractPluginManager
{
    public function enable(array $meta, ContainerInterface $container)
    {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $chatGpt = $entityManager->getRepository(ChatGpt::class)->get();
        if (!$chatGpt) {
            $chatGpt = new ChatGpt();
            $chatGpt->setModel('gpt-3.5-turbo');
            $entityManager->persist($chatGpt);
            $entityManager->flush();
        }
    }
}
