<?php

use App\config\Config;
use App\Container;
use App\repositories\BranchesRepository;
use App\repositories\CompaniesRepository;
use App\repositories\ProductCategoriesRepository;
use App\repositories\ProductsRepository;
use App\repositories\UsersRepository;
use App\repositories\WorkerRequestsRepository;
use App\repositories\WorkersRepository;
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
use App\services\DeleteCompany;
use App\services\DeleteDirectory;
use App\services\DeleteProduct;
use App\services\SaveCompany;
use App\services\DeleteEntity;
use App\services\DeleteFile;
use App\services\FlashVars;
use App\services\GenerateSlug;
use App\services\GetDBConnection;
use App\services\RecoveryAndSendImage;
use App\services\GetUrlAvatar;
use App\services\InitSession;
use App\services\MoveFile;
use App\services\RemoveProfile;
use App\services\SaveBranch;
use App\services\SaveProduct;
use App\services\SaveProductCategory;
use App\services\SendEmailWorkerRequest;
use App\services\UserHasProfile;
use \Faker\Generator as Faker;

$container->add(ErrorHelper::class, function ($container) {
    $service = new ErrorHelper($_SESSION);
    return $service;
});

$container->add(ISendEmailSignUp::class, function ($container) {
    $service = new SendEmailSignUp(
        $container->get(GetURL::class)
    );
    return $service;
});

$container->add(FlashVars::class, function ($container) {
    return new FlashVars($_SESSION);
});

$container->add(Faker::class, function ($container) {
    return new Faker();
});

$container->add(InitSession::class, function ($container) {
    $serviceUserHasProfile = $container->get(UserHasProfile::class);
    $serviceUsersRepository = $container->get(UsersRepository::class);
    $initSession = new InitSession($serviceUserHasProfile, $_SESSION, $serviceUsersRepository);
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
    ->add(MoveFile::class)
    ->add(SaveCompany::class)
    ->add(CreateBranch::class)
    ->add(CompaniesRepository::class)
    ->add(DeleteEntity::class)
    ->add(CreateWorkerRequest::class)
    ->add(SendEmailWorkerRequest::class)
    ->add(AcceptWorkerRequest::class)
    ->add(WorkerRequestsRepository::class)
    ->add(CreateWorker::class)
    ->add(WorkersRepository::class)
    ->add(BranchesRepository::class)
    ->add(Container::class, function ($container) {
        return $container;
    })
    ->add(GenerateSlug::class)
    ->add(SaveBranch::class)
    ->add(GetDBConnection::class)
    ->add(RemoveProfile::class)
    ->add(UserHasProfile::class)
    ->add(ProductsRepository::class)
    ->add(RecoveryAndSendImage::class)
    ->add(SaveProduct::class)
    ->add(DeleteDirectory::class)
    ->add(DeleteProduct::class)
    ->add(DeleteFile::class)
    ->add(DeleteCompany::class)
    ->add(SaveProductCategory::class)
    ->add(ProductCategoriesRepository::class);
