<?php
namespace App\models;

use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;
use phpDocumentor\Reflection\PseudoTypes\True_;

class User extends Model implements IModel{
    const ROLE_SUPERADMIN = 1;
    const ROLE_ADMIN = 2;
    const ROLE_USER = 3;
    const ROLE_WORKER = 4;
    const ROLE_BRANCADMIN = 5;
    const ROLE_DELIVERY = 6;
    const EMAIL_VALIDATED = 1;    
    
    protected $id;
    private $first_name;
    private $last_name;
    private $birthdate;
    private $email;
    private $phone_number;
    private $username;
    private $password;
    private $create_date;
    private $email_validated;
    private $email_hash;
    private $update_at;

    public static function getTable(){
        return 'users';
    }

    public function getId(){
        return $this->id;
    }

    public function setFirst_name($first_name){
        $this->first_name = $first_name;
        return $this;//Regresa el mismo objeto y permite encadenamiento de métodos
    }

    public function getFirst_name(){
        return $this->first_name;
    }

    public function setLast_name($last_name){
        $this->last_name = $last_name;
        return $this;
    }

    public function getLast_name(){
        return $this->last_name;        
    }

    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPhone_number($phone_number){
        $this->phone_number = $phone_number;
    }

    public function getPhone_number(){
        return $this->phone_number;
    }

    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setPassword($password, $hash = false){
        $this->password = $hash ? md5($password) : $password;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setCreate_date($create_date){
        $this->create_date = $create_date;
        return $this;
    }

    public function getCreate_date(){
        return $this->create_date;
    }
    
    public function setEmail_validated($validated){
        $this->email_validated = $validated;
        return $this;
    }

    public function getEmail_validated(){
        return $this->email_validated;
    }

    public function setEmail_hash($email_hash){
        $this->email_hash = $email_hash;
        return $this;
    }

    public function getEmail_hash(){
        return $this->email_hash;
    }

    public static function getAttributes(){
        return [
            'id',
            'first_name',
            'last_name',
            'birthdate',
            'email',
            'phone_number',
            'username',
            'password',
            'create_date',            
            'email_validated',
            'email_hash',
            'updated_at'
        ];
    }
    
    public function setUpdated_at($updateAt){
        $this->update_at = $updateAt;
        return $this;
    }

    public function getUpdated_at(){
        return $this->update_at;
    }
}