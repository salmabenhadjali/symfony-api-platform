<?php
/**
 * Created by PhpStorm.
 * User: salmabha
 * Date: 23/11/2022
 * Time: 16:55
 */

namespace App\Entity;


interface PublishedDateEntityInterface
{
    public function setPublished(\DateTimeInterface $published): PublishedDateEntityInterface;
}