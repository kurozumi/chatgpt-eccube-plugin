<?php

namespace Plugin\ChatGptForEcCube;

use Eccube\Event\TemplateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Event implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            '@admin/Product/product.twig' => 'onRenderAdminProductEdit',
            '@admin/Content/news_edit.twig' => 'onRenderAdminContentNewsEdit',
        ];
    }

    public function onRenderAdminProductEdit(TemplateEvent $event)
    {
        $event->addSnippet('@ChatGptForEcCube/admin/Product/edit.twig');
    }

    public function onRenderAdminContentNewsEdit(TemplateEvent $event)
    {
        $event->addSnippet('@ChatGptForEcCube/admin/Content/news_edit.twig');
    }
}
