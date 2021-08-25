<?php

namespace Tests\traits\users;

use App\models\User;
use App\repositories\UsersRepository;

trait GetFirstUserWithoutWorkerRequest
{
    private function getFirstUserWithoutWorkerRequest(): ?User
    {
        /** @var UsersRepository $usersRepository */
        $usersRepository = $this->getContainer()->get(UsersRepository::class);
        return $usersRepository->getFirstUserWithoutWorkerRequest();

    }
}
