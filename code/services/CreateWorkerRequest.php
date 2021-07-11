<?php

namespace App\services;

use App\models\WorkerRequest;
use DateTime;

class CreateWorkerRequest{

    private $saveEntity;
    private $sendEmailWorkerRequest;

    public function __construct(SaveEntity $saveEntity, SendEmailWorkerRequest $sendEmailWorkerRequest) {
        $this->saveEntity = $saveEntity;
        $this->sendEmailWorkerRequest = $sendEmailWorkerRequest;
    }

    public function __invoke($data) {
        $worker_request = new WorkerRequest();
        $worker_request->fill([        
            'id_company' => $data['id_company'],
            'email' => $data['email'],            
            'create_user' => $data['create_user'],            
        ]);
        $worker_request->setCreate_date(
            (new DateTime())->format('Y-m-d H:i:s')
        );
        $hash = hash('sha224', uniqid());
        $worker_request->setRequest_hash($hash);
        $this->saveEntity->__invoke($worker_request);
        
        $this->sendEmailWorkerRequest->__invoke($data['email']);
        return $worker_request;        
    }

}