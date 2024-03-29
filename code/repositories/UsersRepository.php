<?php

namespace App\repositories;

use App\services\GetDBConnection;
use App\models\User;
use PDO;

class UsersRepository extends Repository
{

    protected function getClassName():string
    {
        return User::class;
    }

    public function getByEmail($email)
    {
        $sql = 'SELECT * FROM users where email = :email';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":email" => $email
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? User::build($result) : null;
    }

    public function getByEmailOrUserName($emailOrUsername)
    {
        $user = $this->getByEmail($emailOrUsername);

        if ($user === null) {
            $user = $this->getByUserName($emailOrUsername);
        }

        return $user;
    }

    public function getByUserName($username)
    {
        $sql = 'SELECT * FROM users where username = :username';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":username" => $username
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ? User::build($result) : null;
    }

    public function getUserProfiles($id)
    {
        $sql = 'SELECT id_rol FROM user_roles where id_user = :id_user';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":id_user" => $id
        ]);

        $result = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $result[] = (int) $row['id_rol'];
        }

        return $result;
    }

    public function getFirstUserWithoutWorkerRequest() : ?User
    {
        $sql = <<<SQL
        select u.* 
        from users u where not exists (select 1 from worker_request wr where wr.email = u.email)
        and not EXISTS (select 1 from user_roles ur where ur.id_rol <> :rol_user and u.id = ur.id_user)
        limit 1
SQL;

        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ':rol_user' => User::ROLE_USER
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result != false ? User::build($result) : null;
    }

}
