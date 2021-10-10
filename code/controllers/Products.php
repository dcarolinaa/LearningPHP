<?php

namespace App\controllers;

use App\Container;
use App\models\Product;
use App\repositories\CompaniesRepository;
use App\repositories\ProductsRepository;
use App\services\DeleteProduct;
use App\services\ErrorHelper;
use App\services\RecoveryAndSendImage;
use App\services\SaveProduct;
use Exception;
use \Faker\Generator as Faker;

class Products extends Controller
{
    private $companyRepository;
    private $productRepository;

    public function __construct(
        string $method,
        Container $container,
        CompaniesRepository $companyRepository,
        ProductsRepository $productRepository
    ) {
        parent::__construct($method, $container);
        $this->companyRepository = $companyRepository;
        $this->productRepository = $productRepository;
    }

    public function index(Faker $faker)
    {
        $slug = $_GET['slug'];
        $company = $this->companyRepository->getBySlug($slug);
        $products = $this->productRepository->getAllByCompanyId($company->getId());

        $this->view('products/index', compact('company', 'products', 'faker'));
    }

    public function create(ErrorHelper $errorHelper)
    {
        $product = new Product();
        $product->fill($_POST);
        $errors = $errorHelper->getAll();

        $company = $this->companyRepository->getBySlug($_GET['slug']);
        $this->view('products/create', compact('company', 'product', 'errors'));
    }

    public function store(
        SaveProduct $saveProduct,
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

        $saveProduct([
            'id_company' => $_POST['id_company'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'id_category' => $_POST['id_category'],
            'image' => $_FILES['image']['tmp_name']
        ]);

        $company = $companiesRepository->getById($_POST['id_company']);

        $this->redirectTo(sprintf('/mis-negocios/%s/productos', $company->getSlug()));
    }

    public function edit(ErrorHelper $errorHelper)
    {
        $product = $this->productRepository->getProductById($_GET['id_product']);
        $company = $this->companyRepository->getById($product->getId_company());
        $errors = $errorHelper->getAll();
        $this->view('products/edit', compact('product', 'company', 'errors'));
    }

    public function update(SaveProduct $saveProduct)
    {
        $saveProduct([
            'id' => $_POST['id'],
            'id_company' => $_POST['id_company'],
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'id_category' => $_POST['id_category'],
            'image' => $_FILES['image']['tmp_name']
        ]);

        $company = $this->companyRepository->getById($_POST['id_company']);

        $this->redirectTo(sprintf('/mis-negocios/%s/productos', $company->getSlug()));
    }

    public function delete(
        DeleteProduct $deleteProduct
    ) {
        $deleteProduct($_GET['id_product']);

        $this->redirectTo(sprintf('/mis-negocios/%s/productos', $_GET['slug']));
    }

    public function confirmDelete(
        ProductsRepository $productsRepository
    ) {
        $product = $productsRepository->getProductById($_GET['id_product']);
        $slug = $_GET['slug'];

        $this->view('components/confirm', [
            'title' => 'Eliminar Producto',
            'text' => sprintf('Deseas eliminar el producto "%s"', $product->getName()),
            'okText' => 'Eliminar',
            'okCss' => 'danger',
            'urlOk' => sprintf('/mis-negocios/%s/productos/%s/delete', $slug, $product->getId()),
            'urlCancel' => sprintf('/mis-negocios/%s/productos', $slug)
        ]);
    }

    public function productImage(
        ProductsRepository $productsRepository,
        string $pathCompanyLogo,
        string $uploadDir,
        string $urlDefaultProductImage,
        RecoveryAndSendImage $recoveryAndSendImage
    ) {
        $product = $productsRepository->getById($_GET['id_product']);
        $file = sprintf(
            '%1$s/%2$s/products/%3$s/product%3$s_image.jpg',
            $uploadDir,
            sprintf($pathCompanyLogo, $product->getId_company()),
            $product->getId()
        );

        try {
            $recoveryAndSendImage($file, $_GET['width']);
        } catch (Exception $ex) {
            $ruta = sprintf($urlDefaultProductImage, $_GET['width'] );
            $this->redirectTo($ruta, true);
        }
    }

    public function defaultImage(
        string $defaultProductImage,
        RecoveryAndSendImage $recoveryAndSendImage
    ) {
        $recoveryAndSendImage($defaultProductImage, $_GET['width']);
    }

}
