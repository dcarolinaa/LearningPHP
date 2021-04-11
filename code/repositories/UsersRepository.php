<?php

namespace App\repositories;

use App\services\GetDBConnection;
use App\models\User;
use PDO;

class UsersRepository{
    private $getDBConnection;

    public function __construct(){
        $this->getDBConnection = new GetDBConnection();
    }

    public function getByEmail($email){
        $sql = 'SELECT * FROM users where email = :email';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":email" => $email
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ?  User::build($result) : null;
    }

    public function getByEmailOrUserName($emailOrUsername){
        $user = $this->getByEmail($emailOrUsername);

        if($user === null){
            $user = $this->getByUserName($emailOrUsername);
        }

        return $user;
    }

    public function getByUserName($username){
        $sql = 'SELECT * FROM users where username = :username';
        $connection = $this->getDBConnection->__invoke();

        $statement = $connection->prepare($sql);
        $statement->execute([
            ":username" => $username
        ]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result !== false ?  User::build($result) : null;
    }

    // public function getAll(){
    //     $sql = 'SELECT * FROM countries';
    //     $connection = $this->getDBConnection->__invoke();
    //     $statement = $connection->prepare($sql);
    //     $statement->execute();
    //     $data = [];
    //     while($result = $statement->fetch(PDO::FETCH_ASSOC)){
    //         $data[] = Country::build($result);
    //     }
    //     return $data;
    // }

    // public function getLast(){
    //     $sql = 'SELECT * from countries order by id desc LIMIT 1';
    //     $connection = $this->getDBConnection->__invoke();
    //     $statement = $connection->prepare($sql);
    //     $statement->execute();
    //     $result = $statement->fetch(PDO::FETCH_ASSOC);

    //     //return Country::build($result);
    //     return $result !== false ?  Country::build($result) : null;
    // }

}