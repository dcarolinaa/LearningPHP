<?php

namespace App\services;

class SendEmailWorkerRequest{

    public function __invoke($email)
    {        
        $message = 'Invitación para unirse a RomiToGo...';
        $header = 'From: romi@romitogo.com'. "\r\n";;
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail($email, 'WORKER REQUEST', $message, $header);   
    }

}