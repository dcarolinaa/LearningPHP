<?php
namespace App\services;

use App\models\User;
use App\repositories\UsersRepository;
use DateTime;

class GetUrlAvatar
{
    private $getURL;
    public function __construct(GetURL $getUrl)
    {
        $this->getURL = $getUrl;
    }
    public function __invoke(User $user, $width = 200)
    {
        return $this->getURL->__invoke('avatar', 'Users', [
            'id' => $user->getId(),
            'width' => $width,
            't' => (new DateTime($user->getUpdated_at()))->format('ymdhis')
        ]);
    }
}
