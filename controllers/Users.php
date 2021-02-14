<?php
namespace App\controllers;

class Users{ //Clase
    public function index(){ //Método        
        include 'views/users/index.php';
    }

    public function edit(){
        include 'views/users/edit.php';
    }

    public function create(){
        include 'views/users/create.php';
    }
}