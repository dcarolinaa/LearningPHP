<?php

use App\repositories\UsersRepository;
use App\services\CreateUser;
use App\services\ErrorHelper;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\ISendEmailSignUp;
use App\services\SaveEntity;
use App\services\SendEmailSignUp;
use App\services\AddProfileToUser;

$container->add(ErrorHelper::class, function($container) {
    $service = new ErrorHelper($_SESSION);
    return $service;
});

$container->add(ISendEmailSignUp::class, function($container){
    $service = new SendEmailSignUp(
        $container->get(GetURL::class)
    );
    return $service;
});

$container->add(CreateUser::class)
    ->add(GetAvatar::class)
    ->add(SaveEntity::class)
    ->add(UsersRepository::class)
    ->add(GetURL::class)
    ->add(AddProfileToUser::class);
