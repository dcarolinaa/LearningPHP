<?php
namespace App\controllers;

class Preferences extends Controller{ //Clase

    public function __constructor(){
        $this->setTitle('Preferences');
    }

    public function index(){ //Método    
        $url = $this->getURL('create');
        $this->view('preferences/index',[
           'preferences' => [],
           'newURL' => $url
        ]);
    }

    public function edit(){
        $this->view('preferences/edit',[]);
    }

    public function create(){
        $this->view('preferences/create',[
            'urlAction' => $this->getURL('store')
        ]);
    }

    public function store(){
        $preference = new \App\models\Preference;
        $preference->setShortName($_POST['shortName']);
        $preference->setName($_POST['name']);
        $preference->save();
        $this->redirectTo($this->getURL('index'));
           
    }


}