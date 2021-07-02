<?php

namespace App\models;

class Branch extends Model implements IModel{

    protected $id;
    private $id_company;
    private $name;
    private $address;
    private $telephone;
    private $cellphone;
    private $email;

    public static function getAttributes(){
        return [
            'id',
            'id_company',
            'name',
            'address',
            'telephone',
            'cellphone',
            'email'
        ];
    }

    public static function getTable(){
        return 'branches';
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

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setAddress($address){
        $this->address = $address;
    }

    public function getAddress(){
        return $this->address;
    }

    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function getTelephone(){
        return $this->telephone;
    }

    public function setCellphone($cellphone){
        $this->cellphone = $cellphone;
    }

    public function getCellphone(){
        return $this->cellphone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }
    
}