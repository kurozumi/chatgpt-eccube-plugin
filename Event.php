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

use Eccube\Event\TemplateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{
    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            '@admin/Product/product.twig' => 'onRenderAdminProductEdit',
            '@admin/Content/news_edit.twig' => 'onRenderAdminContentNewsEdit',
        ];
    }

    /**
     * @param TemplateEvent $event
     *
     * @return void
     */
    public function onRenderAdminProductEdit(TemplateEvent $event): void
    {
        $event->addSnippet('@ChatGpt/admin/Product/edit.twig');
    }

    /**
     * @param TemplateEvent $event
     *
     * @return void
     */
    public function onRenderAdminContentNewsEdit(TemplateEvent $event): void
    {
        $event->addSnippet('@ChatGpt/admin/Content/news_edit.twig');
    }
}
