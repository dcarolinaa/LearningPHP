<?php
namespace App\controllers;

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
}
