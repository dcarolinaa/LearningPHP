<?php

namespace App\services;

use App\repositories\WorkerRequestsRepository;
use App\repositories\UsersRepository;
use App\services\SaveEntity;
use App\models\Worker;
use Exception;


class AcceptWorkerRequest{
    
    private $workerRequestRepository;
    private $saveEntity;
    private $usersRepository;
    private $createWorker;

    public function __construct(
        WorkerRequestsRepository $workerRequestRepository,
        SaveEntity $saveEntity,
        UsersRepository $usersRepository,
        CreateWorker $createWorker
        )
    {
        $this->workerRequestRepository = $workerRequestRepository;
        $this->saveEntity = $saveEntity;
        $this->usersRepository = $usersRepository;
        $this->createWorker = $createWorker;
    }

    public function __invoke(string $hash): Worker
    {
        $workerRequest = $this->workerRequestRepository->getByHash($hash);
        $workerRequest->setAccepted(true);
        $rol = $workerRequest->getRol();

        $this->saveEntity->__invoke($workerRequest);

        $email  = $workerRequest->getEmail();
        $user = $this->usersRepository->getByEmail($email);

        if($user === null){
            throw new Exception('User not found.');
        }

        return $this->createWorker->__invoke([
            'id_company' => $workerRequest->getId_Company(),
            'user' => $user,
            'rol' => $rol
        ]);

    }
}
