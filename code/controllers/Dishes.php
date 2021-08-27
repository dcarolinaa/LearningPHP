<?php

namespace App\controllers;

use App\Container;
use App\repositories\CompaniesRepository;
use \Faker\Generator as Faker;

class Dishes  extends Controller
{
    private $companyRepository;

    public function __construct(string $method, Container $container, CompaniesRepository $companyRepository)
    {
        parent::__construct($method, $container);
        $this->companyRepository = $companyRepository;
    }

    public function index(Faker $faker) {
        $slug = $_GET['slug'];
        $company = $this->companyRepository->getBySlug($slug);
        $dishes = [];
        for ($i=0; $i<20; $i++) {
            $dishes[] = [  
                'id' => $i+1,
                'name' => $faker->words(rand(5,10), true),
                'description' => $faker->words(rand(5,10), true)
            ];

        }

        $this->view('dishes/index', compact('company', 'dishes', 'faker'));
    }

    public function create()
    {
        $company = $this->companyRepository->getBySlug($_GET['slug']);
        $this->view('dishes/create', compact('company'));
    }

    public function store() 
    {

    }

    public function edit() 
    {
        $company = $this->companyRepository->getBySlug($_GET['slug']);
        $this->view('dishes/edit',  compact('company'));
    }

    public function update()
    {

    }

    public function delete () 
    {

    }

    public function confirmDelete() 
    {

    }
}