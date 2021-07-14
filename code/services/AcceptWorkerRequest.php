<?php

namespace App\services;

use App\repositories\WorkerRequestsRepository;
use App\services\SaveEntity;

class AcceptWorkerRequest{
    
    private $workerRequestRepository;
    private $saveEntity;

    public function __construct(
        WorkerRequestsRepository $workerRequestRepository,
        SaveEntity $saveEntity
        )
    {
        $this->workerRequestRepository = $workerRequestRepository;
        $this->saveEntity = $saveEntity;
    }

    public function __invoke($hash)
    {
        $workerRequest = $this->workerRequestRepository->getByHash($hash);
        $workerRequest->setAccepted(true);

        $this->saveEntity->__invoke($workerRequest);
         
    }
}