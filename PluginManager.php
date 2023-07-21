<?php

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
            $entityManager->persist($chatGpt);
            $entityManager->flush();
        }
    }
}
