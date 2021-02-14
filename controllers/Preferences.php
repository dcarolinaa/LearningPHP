<?php
namespace App\controllers;

class Preferences{ //Clase
    public function index(){ //Método        
        include 'views/preferences/index.php';
    }

    public function edit(){
        include 'views/preferences/edit.php';
    }

    public function create(){
        include 'views/preferences/create.php';
    }
}