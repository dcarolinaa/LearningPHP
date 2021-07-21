<?php

use App\config\Config;
use App\models\User;
use App\repositories\CompaniesRepository;
use App\repositories\UsersRepository;
use App\repositories\WorkerRequestsRepository;
use App\services\AcceptWorkerRequest;
use App\services\CreateUser;
use App\services\ErrorHelper;
use App\services\GetAvatar;
use App\services\GetURL;
use App\services\ISendEmailSignUp;
use App\services\SaveEntity;
use App\services\SendEmailSignUp;
use App\services\AddProfileToUser;
use App\services\CreateBranch;
use App\services\CreateWorker;
use App\services\CreateWorkerRequest;
use App\services\SaveCompany;
use App\services\DeleteEntity;
use App\services\FlashVars;
use App\services\GetUrlAvatar;
use App\services\InitSession;
use App\services\SendEmailWorkerRequest;
use App\services\UserHasProfile;

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

$container->add(FlashVars::class, function($container) {
    return new FlashVars($_SESSION);
});

$container->add(InitSession::class, function($container){
    $serviceUserHasProfile = $container->get(UserHasProfile::class);
    $initSession = new InitSession($serviceUserHasProfile, $_SESSION);
    return $initSession;
});

$container->addConfigurations(Config::class);

$container->add(CreateUser::class)
    ->add(GetAvatar::class)
    ->add(GetUrlAvatar::class)
    ->add(SaveEntity::class)
    ->add(UsersRepository::class)
    ->add(GetURL::class)
    ->add(AddProfileToUser::class)
    ->add(UserHasProfile::class)
    ->add(SaveCompany::class)
    ->add(CreateBranch::class)
    ->add(CompaniesRepository::class)
    ->add(DeleteEntity::class)
    ->add(CreateWorkerRequest::class)
    ->add(SendEmailWorkerRequest::class)
    ->add(AcceptWorkerRequest::class)
    ->add(WorkerRequestsRepository::class)
    ->add(CreateWorker::class);