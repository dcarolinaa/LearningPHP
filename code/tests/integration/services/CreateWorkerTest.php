<?php

namespace Tests\integration\services;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\CreateWorker;
use App\services\DeleteEntity;
use Tests\TestCase;

class CreateWorkerTest extends TestCase
{
    public function testCreateWorker(): void
    {
        $usersRepository = $this->getContainer()->get(UsersRepository::class);
        $user = $usersRepository->getFirstUserWithoutWorkerRequest();

        $createWorker = $this->getContainer()->get(CreateWorker::class);
        $worker = $createWorker([
            'id_company' => TestCase::COMPANY_1_ID,
            'branch' => TestCase::COMPANY_1_BRANCH_1,
            'rol' => User::ROLE_DELIVERY,
            'user' => $user
        ]);

        $this->assertNotNull($worker->getId());

        $deleteEntity = $this->getContainer()->get(DeleteEntity::class);
        $deleteEntity($worker);
    }
}
