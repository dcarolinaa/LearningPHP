<?php

namespace App\services;

use App\services\GetDBConnection;
use PDO;

class UserHasProfile
{
    protected $getDBConnection;

    public function __invoke($profile, $userId)
    {
        $this->getDBConnection = new GetDBConnection();
        $conection = $this->getDBConnection->__invoke();

        $sql = 'SELECT * FROM user_roles WHERE id_user = :id_user AND id_rol = :id_rol';
        $statement = $conection->prepare($sql);
        $statement->execute([
            ":id_user" => $userId,
            "id_rol" => $profile
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? true : false;
    }
}
