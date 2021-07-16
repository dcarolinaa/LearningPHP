<?php

namespace App\services;

use App\models\User;

class InitSession{

    private $userHasProfile;

    public function __construct(UserHasProfile $userHasProfile)
    {
        $this->userHasProfile = $userHasProfile;        
    }

    public function __invoke(User $user, &$session)
    {
        $userId = $user->getId();
        $session['loged'] = true;
        $session['username'] = $user->getUserName();
        $session['user_id'] = $user->getId();
        $session['isAdmin'] = $this->userHasProfile->__invoke(User::ROLE_ADMIN, $userId);
        $session['isSuperAdmin'] = $this->userHasProfile->__invoke(User::ROLE_SUPERADMIN, $userId);                
    }

}