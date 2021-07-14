<?php

namespace App\services;

use App\models\Worker;
use App\models\WorkerRequest;

class SendEmailWorkerRequest{

    // private $baseUrl;

    // public function __construct(string $baseUrl)
    // {
    //     $this->baseUrl = $baseUrl;        
    // }

    public function __invoke(WorkerRequest $workerRequest)
    {        
        $email = $workerRequest->getEmail();
        $url = sprintf('%s/aceptar-invitacion/%s/%s',BASE_URL, $workerRequest->getId_company(), $workerRequest->getRequest_hash());
        $message = sprintf('Invitación para unirse a RomiToGo... <a href="%s" > Aceptar Invitación </a> ', $url);
        $header = 'From: romi@romitogo.com'. "\r\n";;
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        mail($email, 'WORKER REQUEST', $message, $header);   
    }

}