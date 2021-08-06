<?php
namespace App\services;

class GetAvatar
{
    const DEFAULT_AVATAR = 'img/defaultAvatar.jpg';

    public function __invoke($userId)
    {
        $extensions = ['jpg','png','gif'];
        foreach ($extensions as $extension) {
            $file = sprintf('upload/users/%s/avatar.%s', $userId, $extension);
            if (file_exists($file)) {
                return $file;
            }
        }

        return self::DEFAULT_AVATAR;
    }
}
