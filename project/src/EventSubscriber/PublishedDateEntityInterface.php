<?php
/**
 * Created by PhpStorm.
 * User: salmabha
 * Date: 23/11/2022
 * Time: 16:42
 */

namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class PublishedDateEntityInterface implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }
}