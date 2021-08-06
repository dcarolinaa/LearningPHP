<?php
namespace App\services;

use App\models\User;
use App\services\GetDBConnection;
use Exception;

class AddProfileToUser
{
    protected $getConnection;

    public function __construct()
    {
        $this->getConnection = new GetDBConnection();
    }

    public function __invoke(User $user, $rol)
    {
        $conection = $this->getConnection->__invoke();

        try {
            $insert = 'Insert into user_roles(id_user, id_rol) values(:id_user, :id_rol)';
            $insertStatement = $conection->prepare($insert);
            $insertStatement->execute([
                ':id_user' => $user->getId(),
                ':id_rol' => $rol
            ]);

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
