<?php
namespace App\controllers;

use App\services\SaveEntity;
use App\models\Country;
use App\repositories\CountriesRepository;
use App\services\DeleteEntity;
use App\services\GetURL;

class Countries extends Controller{ //Clase
    public function index(){ //Método        
        $countriesRepository = new CountriesRepository;
        $countries = $countriesRepository->getAll();
        $getULR = new GetURL;
        $this->view('countries/index',[
            'countries' => $countries,
            'newURL' => $getULR('create', $this)
        ]);
    }

    public function edit(){
        $countriesRepository = new CountriesRepository;
        $country = $countriesRepository->getById($_GET['id']);
        $this->view('countries/edit', [
            'country' => $country
        ]);
    }

    public function create(){        
        $getULR = new GetURL;        
        $this->view('countries/create', [
            'country' => new Country,
            'urlAction' => $getULR('store', $this)
        ]);
    }

    public function store(){
        $saveEntity = new SaveEntity();
        $country = new \App\models\Country;
        $country->fill($_POST);
        $saveEntity($country);
        
        //var_dump($country->getId());

        $this->redirectTo($this->getURL('index'));
    }

    public function update(){
        $countriesRepository = new CountriesRepository();
        $saveEntity = new SaveEntity();
        $country = $countriesRepository->getById($_POST['id']);
        $country->fill($_POST);
        $saveEntity($country);
        $this->redirectTo($this->getURL('index'));    
    }

    public function delete(){
        $countriesRepository = new CountriesRepository();
        $deleteEntity = new DeleteEntity();

        $country = $countriesRepository->getById($_GET['id']);        
        $deleteEntity($country);

        $this->redirectTo($this->getURL('index'));
    }

}
