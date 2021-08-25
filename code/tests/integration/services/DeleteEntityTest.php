<?php

namespace Tests\integration\services;

use App\models\User;
use App\repositories\WorkerRequestsRepository;
use App\services\CreateWorkerRequest;
use App\services\DeleteEntity;
use Tests\TestCase;
use Tests\traits\users\GetFirstUserWithoutWorkerRequest;

class DeleteEntityTest extends TestCase
{
    use GetFirstUserWithoutWorkerRequest;

    public function testDeleteEntity()
    {
        $user = $this->getFirstUserWithoutWorkerRequest();

        $createWorkerRequest = $this->getContainer()->get(CreateWorkerRequest::class);
        $workerRequest = $createWorkerRequest([
            'id_company' => TestCase::COMPANY_1_ID,
            'email' => $user->getEmail(),
            'create_user' => TestCase::ADMIN_COMPANY_1_ID,
            'rol' => User::ROLE_DELIVERY,
            'branch' => TestCase::COMPANY_1_BRANCH_1
        ]);

        $id = $workerRequest->getId();

        $this->assertNotNull($id);

        $deleteEntity = $this->getContainer()->get(DeleteEntity::class);
        $deleteEntity($workerRequest);

        $workerRequestsRepository = $this->getContainer()->get(WorkerRequestsRepository::class);
        $workerRequest = $workerRequestsRepository->getById($id);

        $this->assertNull($workerRequest);
    }
}
