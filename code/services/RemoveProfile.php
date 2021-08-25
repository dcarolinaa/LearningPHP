<?php

namespace App\services;

use App\models\User;
use Exception;

class RemoveProfile
{
    protected $getConnection;

    public function __construct(GetDBConnection $getConnection)
    {
        $this->getConnection = $getConnection;
    }

    public function __invoke(User $user, int $rol): bool
    {
        $conection = $this->getConnection->__invoke();

        try {
            $insert = 'Delete from user_roles where id_user = :id_user and id_rol = :id_rol';
            $insertStatement = $conection->prepare($insert);
            $success = $insertStatement->execute([
                ':id_user' => $user->getId(),
                ':id_rol' => $rol
            ]);

            if ($success) {
                return true;
            } else {
                throw new Exception("Error");
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
