<?php

namespace App\models;

class WorkerRequest extends Model implements IModel{

    protected $id;
    private $id_company;
    private $email;
    private $create_date;
    private $create_user;
    private $request_hash;
    private $accepted;

    public static function getAttributes()
    {
        return [
            'id',
            'id_company',
            'email',
            'create_date',
            'create_user',
            'request_hash',
            'accepted'
        ];
    }

    public static function getTable(){
        return 'worker_request';
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId_company($id_company){
        $this->id_company = $id_company;
    }

    public function getId_company(){
        return $this->id_company;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setCreate_date($create_date){
        $this->create_date = $create_date;
    }

    public function getCreate_date(){
        return $this->create_date;
    }

    public function setCreate_user($create_user){
        $this->create_user = $create_user;
    }

    public function getCreate_user(){
        return $this->create_user;
    }

    public function setRequest_hash($request_hash){
        $this->request_hash = $request_hash;
    }

    public function getRequest_hash(){
        return $this->request_hash;
    }
    
    public function setAccepted($accepted){
        $this->accepted = $accepted;
    }

    public function getAccepted(){
        return $this->accepted;
    }

}