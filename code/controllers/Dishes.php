<?php

namespace App\controllers;

use App\Container;
use App\models\Dish;
use App\repositories\CompaniesRepository;
use App\repositories\DishesRepository;
use App\services\CreateDish;
use App\services\DeleteEntity;
use App\services\ErrorHelper;
use \Faker\Generator as Faker;

class Dishes  extends Controller
{
    private $companyRepository;
    private $dishesRepository;

    public function __construct(
        string $method, 
        Container $container, 
        CompaniesRepository $companyRepository,
        DishesRepository $dishesRepository
        )
    {
        parent::__construct($method, $container);
        $this->companyRepository = $companyRepository;
        $this->dishesRepository = $dishesRepository;
    }

    public function index(Faker $faker) {        
        $slug = $_GET['slug'];
        $company = $this->companyRepository->getBySlug($slug);
        $dishes = $this->dishesRepository->getAllByCompanyId($company->getId());

        $this->view('dishes/index', compact('company', 'dishes', 'faker'));
    }

    public function create(ErrorHelper $errorHelper)
    {
        $dish = new Dish();
        $dish->fill($_POST);
        $errors = $errorHelper->getAll();

        $company = $this->companyRepository->getBySlug($_GET['slug']);
        $this->view('dishes/create', compact('company', 'dish', 'errors'));
    }

    public function store(
        CreateDish $createDish,
        CompaniesRepository $companiesRepository,
        ErrorHelper $errorHelper) 
    {        
        $requiredAttributes = ['name', 'description'];

        foreach ($requiredAttributes as $attribute) {
            if (trim($_POST[$attribute]) == '') {
                $errorHelper->set($attribute, '_empty', 'Campo obligatorio');
            }
        }

        if ($errorHelper->hasErrors()) {
            $this->create($errorHelper);
            return;
        }

        $createDish($_POST);

        $company = $companiesRepository->getById($_POST['id_company']);

        $this->redirectTo(sprintf('/mis-negocios/%s/platillos', $company->getSlug()));
    }

    public function edit() 
    {
        $faker = $this->getContainer()->get(Faker::class);
        $dish = new Dish();
        $dish->setId(rand(100,1000));
        $dish->setName($faker->words(3,true));
        $dish->setDescription($faker->words(rand(5,20),true));
        $errors = [];
        $company = $this->companyRepository->getBySlug($_GET['slug']);
        $this->view('dishes/edit',  compact('company', 'dish', 'errors'));
    }

    public function update()
    {
        $company = $this->companyRepository->getBySlug($_GET['slug']);
        $this->redirectTo(sprintf('/mis-negocios/%s/platillos', $company->getSlug()));
    }

    public function delete (DishesRepository $dishesRepository, DeleteEntity $deleteEntity) 
    {        
        $dish = $dishesRepository->getDishById($_GET['id_dish']);
        $deleteEntity($dish);
    
        $this->redirectTo(sprintf('/mis-negocios/%s/platillos', $_GET['slug']));        
    }

    public function confirmDelete(
        DishesRepository $dishesRepository        
    ) 
    {                      
        $dish = $dishesRepository->getDishById($_GET['id_dish']);       
        $slug = $_GET['slug'];

        $this->view('components/confirm', [
            'title' => 'Eliminar Platillo',
            'text' => sprintf('Deseas eliminar el platillo "%s"', $dish->getName()),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/platillos/%s/delete', $slug, $dish->getId()),
            'urlCancel' => sprintf('/mis-negocios/%s/platillos', $slug)
        ]);        
        
    }
}