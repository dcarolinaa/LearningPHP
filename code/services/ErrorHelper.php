<?php
namespace App\services;

class ErrorHelper{
    private $store;

    public function __construct(& $store){ //Pase por referencia "&"
        $this->store = & $store; //Asignación por referencia
        if(!isset($this->store['_errors'])){
            $this->store['_errors'] = [];   
        }
    }

    public function set($attribute, $error, $value){
        if(!isset($this->store['_errors'][$attribute])){
            $this->store['_errors'][$attribute] = [];
        }
        $this->store['_errors'][$attribute][$error] = $value;
    }

    public function get($key){
        if(isset($this->store[$key])){
            $value = $this->store[$key];
            unset($this->store[$key]);
            
            return $value;
        }
        
        return null;
    }

    public function getAll(){
        $errors = $this->store['_errors'];
        $this->store['_errors'] = [];
        return count($errors) ? $errors : false;
    }

    public function hasErrors(){
        return count($this->store['_errors'])>0;
    }
}