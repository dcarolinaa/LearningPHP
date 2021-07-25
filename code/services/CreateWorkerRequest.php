<?php

namespace App\services;

use App\models\WorkerRequest;
use DateTime;

class CreateWorkerRequest{

    private $saveEntity;
    private $sendEmailWorkerRequest;

    public function __construct(SaveEntity $saveEntity, SendEmailWorkerRequest $sendEmailWorkerRequest) 
    {
        $this->saveEntity = $saveEntity;
        $this->sendEmailWorkerRequest = $sendEmailWorkerRequest;
    }

    public function __invoke($data) {
        $workerRequest = new WorkerRequest();
        $workerRequest->fill([        
            'id_company' => $data['id_company'],
            'email' => $data['email'],            
            'create_user' => $data['create_user'],
            'accepted' => WorkerRequest::NOT_ACCEPTED,
            'rol' => $data['rol'],
            'branch' => $data['branch']
        ]);
        $workerRequest->setCreate_date(
            (new DateTime())->format('Y-m-d H:i:s')
        );
        $hash = hash('sha224', uniqid());
        $workerRequest->setRequest_hash($hash);
        $this->saveEntity->__invoke($workerRequest);
        
        $this->sendEmailWorkerRequest->__invoke($workerRequest);
        return $workerRequest;        
    }

}
