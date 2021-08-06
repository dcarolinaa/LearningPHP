<?php

use App\services\ISendEmailSignUp;
use App\services\SendEmailSignUpOFF;

$container->add(ISendEmailSignUp::class, function () {
    return new SendEmailSignUpOFF();
});
