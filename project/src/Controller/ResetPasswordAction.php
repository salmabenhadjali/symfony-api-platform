<?php
/**
 * Created by PhpStorm.
 * User: salmabha
 * Date: 10/01/2023
 * Time: 15:23
 */

namespace App\Controller;


use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\User;

class ResetPasswordAction
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function __invoke(User $data)
    {
        //$reset = new ResetPasswordAction();
        //$reset();
//        var_dump(
//            $data->getNewPassword(),
//            $data->getNewRetypedPassword(),
//            $data->getOldPassword(),
//            $data->getRetypedPassword()
//        );die;

        //validator is only called after we return the data from this action!
        $this->validator->validate($data);
    }
}