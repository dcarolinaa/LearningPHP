<?php

namespace App\services;

use App\models\User;
use DateTime;
use App\services\AddProfileToUser;

class CreateUser{

    private $saveEntity;
    private $sendEmailSignUp;
    private $addProfileUser;

    public function __construct(
        SaveEntity $saveEntity, 
        ISendEmailSignUp $sendEmailSignUp,
        AddProfileToUser $addProfileUser
    ){
        $this->saveEntity = $saveEntity;
        $this->sendEmailSignUp = $sendEmailSignUp;
        $this->addProfileUser = $addProfileUser;
    }

    public function __invoke($data)
    {
        $user = new User;
        $user->fill(
            [                
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'birthdate' => $data['birthdate'],
                'email' => $data['email'],
                'username' => $data['username']
            ]);
        $user->setCreate_date(
            (new DateTime())->format('Y-m-d H:i:s')
        );        
        $user->setPassword($data['password'], true);
        $hash = hash('sha224', uniqid());
        $user->setEmail_hash($hash);
        
        $this->saveEntity->__invoke($user);
        $this->sendEmailSignUp->__invoke($user, $hash);
        $this->addProfileUser->__invoke($user, User::ROLE_USER);
        return $user;
    }
}