<?php

namespace App\services;

use App\models\User;
use App\repositories\UsersRepository;

class InitSession
{

    private $userHasProfile;
    private $session;
    private $usersRepository;

    public function __construct(UserHasProfile $userHasProfile, &$session, UsersRepository $usersRepository)
    {
        $this->userHasProfile = $userHasProfile;
        $this->session = &$session;
        $this->usersRepository = $usersRepository;
    }

    public function __invoke(User $user)
    {
        $this->session = [];
        $userId = $user->getId();
        $this->session['loged'] = true;
        $this->session['username'] = $user->getUserName();
        $this->session['user_id'] = $user->getId();
        $this->session['isAdmin'] = $this->userHasProfile->__invoke(User::ROLE_ADMIN, $userId);
        $this->session['isSuperAdmin'] = $this->userHasProfile->__invoke(User::ROLE_SUPERADMIN, $userId);
        $this->session['roles'] = $this->usersRepository->getUserProfiles($userId);
    }

}
