<?php

namespace Tests\integration\services;

use App\models\User;
use App\repositories\UsersRepository;
use App\services\AcceptWorkerRequest;
use App\services\CreateWorkerRequest;
use App\services\UserHasProfile;
use Tests\TestCase;

class AcceptWorkerRequestTest extends TestCase
{
    public function testAcceptRequestWithExistUser()
    {
        /** @var UsersRepository $usersRepository */
        $usersRepository = $this->getContainer()->get(UsersRepository::class);
        $user = $usersRepository->getFirstUserWithoutWorkerRequest();

        $createWorkerRequest = $this->getContainer()->get(CreateWorkerRequest::class);
        $workerRequest = $createWorkerRequest([
            'id_company' => TestCase::COMPANY_1_ID,
            'email' => $user->getEmail(),
            'create_user' => TestCase::ADMIN_COMPANY_1_ID,
            'rol' => User::ROLE_DELIVERY,
            'branch' => TestCase::COMPANY_1_BRANCH_1
        ]);

        $acceptWorkerRequest = $this->getContainer()->get(AcceptWorkerRequest::class);
        $acceptWorkerRequest($workerRequest->getRequest_hash());

        $userHasProfile = $this->getContainer()->get(UserHasProfile::class);

        $this->assertTrue($userHasProfile(User::ROLE_DELIVERY, $user->getId()));
    }
}
