<?php
/**
 * Created by PhpStorm.
 * User: salmabha
 * Date: 20/10/2022
 * Time: 08:51
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\PublishedDateEntityInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;


class PublishedDateEntitySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setPublishedDate', EventPriorities::PRE_WRITE]
        ];
    }

    public function setPublishedDate(GetResponseForControllerResultEvent $event)
    {

        $entity = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ((!$entity instanceof PublishedDateEntityInterface) || $method !== Request::METHOD_POST) {
            return;
        }

        $entity->setPublished(new \DateTime());
    }
}