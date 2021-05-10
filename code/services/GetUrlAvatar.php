<?php
namespace App\services;

use App\models\User;
use App\repositories\UsersRepository;
use DateTime;

class GetUrlAvatar{
    
    public function __invoke(User $user, $width = 200){        
        $getURL = new GetURL();
        return $getURL('avatar','Users', [
            'id' =>  $user->getId(),
            'width' => $width,
            't' => (new DateTime($user->getUpdated_at()))->format('ymdhis')
        ]);        
    }
}