<?php
namespace App\models;

class Country implements IModel{
    private $id;
    private $name;
    private $code;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getCode(){
        return $this->code;
    }

    public function setCode($code){
        $this->code = $code;
    }

    public static function getAttributes(){
        return [
            'id',
            'code',
            'name'
        ];
    }

    public static function getTable(){
        return 'countries';
    }
}