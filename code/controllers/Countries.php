<?php
namespace App\controllers;

use App\services\SaveEntity;

class Countries extends Controller{ //Clase
    public function index(){ //Método        
        //echo "Hola POO!";
        include 'views/countries/index.php';
    }

    public function edit(){
        include 'views/countries/edit.php';
    }

    public function create(){
        include 'views/countries/create.php';
    }

    public function store(){
        $saveEntity = new SaveEntity();
        $country = new \App\models\Country;
        $country->fill($_POST);
        $saveEntity($country);
        
        //var_dump($country->getId());

        $this->redirectTo($this->getURL('index'));
    }
}
