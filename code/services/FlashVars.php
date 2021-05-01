<?php
namespace App\services;

class FlashVars{
    private $store;

    public function __construct(& $store){ //Pase por referencia "&"
        $this->store = & $store; //Asignación por referencia
    }

    public function set($key, $value){
        $this->store[$key] = $value;
    }

    public function get($key){
        if(isset($this->store[$key])){
            $value = $this->store[$key];
            unset($this->store[$key]);
            
            return $value;
        }
        
        return null;
    }
}