<?php

namespace App\services;

use App\models\User;
use DateTime;

class CreateUser{

    private $saveEntity;
    private $sendEmailSignUp;

    public function __construct(SaveEntity $saveEntity, ISendEmailSignUp $sendEmailSignUp)
    {
        $this->saveEntity = $saveEntity;
        $this->sendEmailSignUp = $sendEmailSignUp;
    }

    public function __invoke($data)
    {
        $user = new User;
        $user->fill($data);
        $user->setCreate_date(
            (new DateTime())->format('Y-m-d H:i:s')
        );
        $user->setRole_id(User::ROLE_USER);
        $user->setPassword($data['password'], true);
        $hash = hash('sha224', uniqid());
        $user->setEmail_hash($hash);
        
        $this->saveEntity->__invoke($user);
        $this->sendEmailSignUp->__invoke($user, $hash);       
    }

}