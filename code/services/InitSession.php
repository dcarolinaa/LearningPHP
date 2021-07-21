<?php

namespace App\services;

use App\models\User;

class InitSession{

    private $userHasProfile;
    private $session;

    public function __construct(UserHasProfile $userHasProfile, &$session)
    {
        $this->userHasProfile = $userHasProfile;
        $this->session = &$session;
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
    }

}