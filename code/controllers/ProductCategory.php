<?php
namespace App\controllers;

use App\models\ProductCategory as Category;
use App\repositories\CompaniesRepository;
use App\Container;
use App\services\ErrorHelper;

class ProductCategory extends Controller
{

    public function __construct(
        string $method,
        Container $container,
        CompaniesRepository $companyRepository
    ) {
        parent::__construct($method, $container);
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $slug = $_GET['slug'];
        $company = $this->companyRepository->getBySlug($slug);

        $this->view('product-category/index', [
            'categories' => [
                (new Category)->fill(['name' => 'category1', 'id' => 1]),
                (new Category)->fill(['name' => 'category2', 'id' => 2])
            ],
            'company' => $company
        ]);
    }

    public function create(ErrorHelper $errorHelper)
    {
        $slug = $_GET['slug'];

        $company = $this->companyRepository->getBySlug($slug);
        $fakeCategory = (new Category)->fill(['name' => 'category1', 'id' => 1]);
        $errors = $errorHelper->getAll();

        $this->view('product-category/create', [
            'category' => $fakeCategory,
            'company' => $company,
            'errors' => $errors
        ]);
    }

    public function store()
    {
        $slug = $_GET['slug'];
        $company = $this->companyRepository->getBySlug($slug);
        $this->redirectTo(sprintf('/mis-negocios/%s/categorias-de-productos', $company->getSlug()));
    }

    public function edit(ErrorHelper $errorHelper)
    {
        $slug = $_GET['slug'];

        $company = $this->companyRepository->getBySlug($slug);
        $fakeCategory = (new Category)->fill(['name' => 'category1', 'id' => 1]);
        $errors = $errorHelper->getAll();

        $this->view('product-category/edit', [
            'category' => $fakeCategory,
            'company' => $company,
            'errors' => $errors
        ]);
    }

    public function update()
    {
        $slug = $_GET['slug'];
        $company = $this->companyRepository->getBySlug($slug);
        $this->redirectTo(sprintf('/mis-negocios/%s/categorias-de-productos', $company->getSlug()));
    }

    public function confirmDelete(ErrorHelper $errorHelper)
    {
        $category = (new Category)->fill(['name' => 'category1', 'id' => 1]);
        $errors = $errorHelper->getAll();
        $slug = $_GET['slug'];

        $this->view('components/confirm', [
            'title' => 'Eliminar La Categoria',
            'text' => sprintf('Deseas eliminar la categoria "%s"', $category->getName()),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/categorias-de-productos/%s/delete', $slug, $category->getId()),
            'urlCancel' => sprintf('/mis-negocios/%s/categorias-de-productos', $slug)
        ]);
    }

    public function delete()
    {
        $this->redirectTo(sprintf('/mis-negocios/%s/categorias-de-productos', $_GET['slug']));
    }

}
