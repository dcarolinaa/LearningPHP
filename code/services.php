<?php

use App\repositories\UsersRepository;
use App\services\CreateUser;
use App\services\ErrorHelper;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\GetUrlAvatar;
use App\services\SaveEntity;
use App\services\SendEmailSignUp;
use Imagine\Filter\Basic\Save;

$container->add(ErrorHelper::class, function() {
    $service = new ErrorHelper($_SESSION);
    return $service;
});

$container->add(GetAvatar::class, function(){
    $service = new GetAvatar();
    return $service;
});

$container->add(SaveEntity::class, function(){
    $service = new SaveEntity();
    return $service;
});

$container->add(UsersRepository::class, function(){
    $service = new UsersRepository();
    return $service;
});

$container->add(GetURL::class, function(){
    $service = new GetURL();
    return $service;
});

$container->add(ISendEmailSignUp::class, function($container){
    $service = new SendEmailSignUp(
        $container->get(GetURL::class)
    );
    return $service;
});

$container->add(CreateUser::class, function($container){
    $service = new CreateUser(
        $container->get(SaveEntity::class),
        $container->get(ISendEmailSignUp::class)
    );

    return $service;
});
