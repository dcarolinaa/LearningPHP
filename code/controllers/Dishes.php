<?php

namespace App\controllers;

use App\Container;
use App\models\Dish;
use App\repositories\CompaniesRepository;
use App\repositories\DishesRepository;
use App\services\DeleteDish;
use App\services\ErrorHelper;
use App\services\RecoveryAndSendImage;
use App\services\SaveDish;
use Exception;
use \Faker\Generator as Faker;

class Dishes extends Controller
{
    private $companyRepository;
    private $dishesRepository;

    public function __construct(
        string $method,
        Container $container,
        CompaniesRepository $companyRepository,
        DishesRepository $dishesRepository
    ) {
        parent::__construct($method, $container);
        $this->companyRepository = $companyRepository;
        $this->dishesRepository = $dishesRepository;
    }

    public function index(Faker $faker)
    {
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
        SaveDish $saveDish,
        CompaniesRepository $companiesRepository,
        ErrorHelper $errorHelper
    ) {
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

        $saveDish([
            'id_company' => $_POST['id_company'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'image' => $_FILES['image']['tmp_name']
        ]);

        $company = $companiesRepository->getById($_POST['id_company']);

        $this->redirectTo(sprintf('/mis-negocios/%s/platillos', $company->getSlug()));
    }

    public function edit(ErrorHelper $errorHelper)
    {
        $dish = $this->dishesRepository->getDishById($_GET['id_dish']);
        $company = $this->companyRepository->getById($dish->getId_company());
        $errors = $errorHelper->getAll();
        $this->view('dishes/edit', compact('dish', 'company', 'errors'));
    }

    public function update(SaveDish $saveDish)
    {
        $saveDish([
            'id' => $_POST['id'],
            'id_company' => $_POST['id_company'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'image' => $_FILES['image']['tmp_name']
        ]);

        $company = $this->companyRepository->getById($_POST['id_company']);

        $this->redirectTo(sprintf('/mis-negocios/%s/platillos', $company->getSlug()));
    }

    public function delete(
        DeleteDish $deleteDish
    ) {
        $deleteDish($_GET['id_dish']);

        $this->redirectTo(sprintf('/mis-negocios/%s/platillos', $_GET['slug']));
    }

    public function confirmDelete(
        DishesRepository $dishesRepository
    ) {
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

    public function dishImage(
        DishesRepository $dishesRepository,
        string $pathCompanyLogo,
        string $uploadDir,
        string $urlDefaultDishImage,
        RecoveryAndSendImage $recoveryAndSendImage
    ) {
        $dish = $dishesRepository->getById($_GET['id_dish']);
        $file = sprintf(
            '%1$s/%2$s/dishes/%3$s/dish%3$s_image.jpg',
            $uploadDir,
            sprintf($pathCompanyLogo, $dish->getId_company()),
            $dish->getId()
        );

        try {
            $recoveryAndSendImage($file, $_GET['width']);
        } catch (Exception $ex) {
            $ruta = sprintf($urlDefaultDishImage, $_GET['width'] );
            $this->redirectTo($ruta, true);
        }
    }

    public function defaultImage(
        string $defaultDishImage,
        RecoveryAndSendImage $recoveryAndSendImage
    ) {
        $recoveryAndSendImage($defaultDishImage, $_GET['width']);
    }

}
