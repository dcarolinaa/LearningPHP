<?php
namespace App\models;

class User extends Model implements IModel{
    public function getId(){
        return $this->id;
    }

    public static function getTable(){
        return 'users';
    }

    public static function getAttributes(){
        return [
            'id',
            'first_name',
            'last_name',
            'birthdate',
            'email',
            'username',
            'password',
            'create_date',
            'role',
            'email_validated'
        ];
    }
}