<?php
namespace App\controllers;

use App\models\Preference;
use App\services\GetURL;

class Preferences extends Controller{ //Clase

    public function __constructor(){
        $this->setTitle('Preferences');
    }

    public function index(){ //Método
        $preferences = Preference::getAll();         
        $url = $this->getURL('create');
        $getURL = new GetURL;
        $this->view('preferences/index',[
           'preferences' => $preferences,
           'newURL' => $url,
           'getURL' => $getURL
        ]);
    }

    public function edit(){
        $preference = Preference::getById($_GET['id']);
        $this->view('preferences/edit',[
            'urlAction' => $this->getURL('update'),
            'preference' => $preference
        ]);        
    }

    public function update(){
        $preference = Preference::getById($_POST['id']);        
        $preference->fill($_POST);
        $preference->save();
        $this->redirectTo($this->getURL('index'));
    }

    public function delete(){
        $preference = Preference::getById($_GET['id']);
        $preference->delete();
        $this->redirectTo($this->getURL('index'));
    }

    public function create(){
        $preference = new Preference;
        $this->view('preferences/create',[
            'urlAction' => $this->getURL('store'),
            'preference' => $preference
        ]);
    }

    public function store(){
        $preference = new \App\models\Preference;
        $preference->fill($_POST);
        $preference->save();
        $this->redirectTo($this->getURL('index'));
           
    }


}