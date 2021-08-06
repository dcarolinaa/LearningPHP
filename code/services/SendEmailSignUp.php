<?php

namespace App\services;

class SendEmailSignUp implements ISendEmailSignUp
{

    private $getURL;

    public function __construct(GetURL $getURL)
    {
        $this->getURL = $getURL;
    }

    public function __invoke($user, $hash)
    {
        $link = $this->getURL->__invoke('validateEmail', 'Users', [
            'hash' => $hash,
            'email' => $user->getEmail()
        ], false);

        $message = sprintf('Hola, bienvenido a RomiToGo, activa tu cuenta con el siguiente link: <a href="%1$s">%1$s</a>', $link);
        $header = 'From: romi@romitogo.com' . "\r\n";
        ;
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail($user->getEmail(), 'WELCOME', $message, $header);
    }

}
