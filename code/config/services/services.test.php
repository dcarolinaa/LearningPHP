<?php

use App\config\ConfigTest;
use App\services\ISendEmailSignUp;
use \Faker\Factory as Fakerfactory;
use \Faker\Generator as Faker;
use App\services\SendEmailSignUpOFF;

$container->add(Faker::class, function () {
    return FakerFactory::create();
});

$container->add(ISendEmailSignUp::class, function () {
    return new SendEmailSignUpOFF();
});

$container->addConfigurations(ConfigTest::class)
    ->add('Client');
