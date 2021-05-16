<?php

namespace App\services;

interface ISendEmailSignUp{
    public function __invoke($user, $hash);
}