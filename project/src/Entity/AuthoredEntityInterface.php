<?php
/**
 * Created by PhpStorm.
 * User: salmabha
 * Date: 23/11/2022
 * Time: 16:35
 */

namespace App\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

interface AuthoredEntityInterface
{
    public function setAuthor(UserInterface $user): AuthoredEntityInterface;

}