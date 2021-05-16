<?php

use App\services\ISendEmailSignUp;
use App\services\SendEmailSignUpOFF;

$container->add(SendEmailSignUpOFF::class, function(){
    return new SendEmailSignUpOFF();
});

