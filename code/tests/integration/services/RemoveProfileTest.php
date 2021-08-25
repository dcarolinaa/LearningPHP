<?php

namespace Tests\integration\services;

use App\models\User;
use App\services\AddProfileToUser;
use App\services\RemoveProfile;
use App\services\UserHasProfile;
use Tests\TestCase;
use Tests\traits\users\GetFirstUserWithoutWorkerRequest;

class RemoveProfileTest extends TestCase
{
    use GetFirstUserWithoutWorkerRequest;

    public function testRemoveProfile()
    {
        $user = $this->getFirstUserWithoutWorkerRequest();

        $addProfileToUser = $this->getContainer()->get(AddProfileToUser::class);
        $addProfileToUser($user, User::ROLE_DELIVERY);

        $userHasProfile = $this->getContainer()->get(UserHasProfile::class);
        $this->assertTrue($userHasProfile(User::ROLE_DELIVERY, $user->getId()));

        $removeProfile = $this->getContainer()->get(RemoveProfile::class);
        $removeProfile($user, User::ROLE_DELIVERY);

        $this->assertFalse($userHasProfile(User::ROLE_DELIVERY, $user->getId()));

    }
}
