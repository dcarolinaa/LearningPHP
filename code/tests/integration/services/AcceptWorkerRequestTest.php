<?php

namespace Tests\integration\services;

use App\models\User;
use App\services\AcceptWorkerRequest;
use App\services\CreateWorkerRequest;
use App\services\DeleteEntity;
use App\services\RemoveProfile;
use App\services\UserHasProfile;
use Tests\TestCase;
use Tests\traits\users\GetFirstUserWithoutWorkerRequest;

class AcceptWorkerRequestTest extends TestCase
{
    use GetFirstUserWithoutWorkerRequest;

    public function testAcceptRequestWithExistUser()
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

        $acceptWorkerRequest = $this->getContainer()->get(AcceptWorkerRequest::class);
        $worker = $acceptWorkerRequest($workerRequest->getRequest_hash());

        $userHasProfile = $this->getContainer()->get(UserHasProfile::class);

        $this->assertTrue($userHasProfile(User::ROLE_DELIVERY, $user->getId()));

        $removeProfile = $this->getContainer()->get(RemoveProfile::class);
        $removeProfile($user, User::ROLE_DELIVERY);
        $deleteEntity = $this->getContainer()->get(DeleteEntity::class);
        $deleteEntity($worker);
        $deleteEntity($workerRequest);

    }
}
