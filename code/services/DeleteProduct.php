<?php

namespace App\services;

use App\repositories\ProductsRepository;

class DeleteProduct
{
    private $productsRepository;
    private $deleteDirectory;
    private $pathCompanyLogo;
    private $deleteEntity;
    private $uploadDir;
    private $homeDir;

    public function __construct(
        ProductsRepository $productsRepository,
        DeleteDirectory $deleteDirectory,
        DeleteEntity $deleteEntity,
        string $pathCompanyLogo,
        string $uploadDir,
        string $homeDir
    ) {
        $this->deleteEntity = $deleteEntity;
        $this->deleteDirectory = $deleteDirectory;
        $this->productsRepository = $productsRepository;
        $this->uploadDir = $uploadDir;
        $this->pathCompanyLogo = $pathCompanyLogo;
        $this->homeDir = $homeDir;
    }

    public function __invoke($id)
    {
        $product = $this->productsRepository->getProductById($id);

        $productsImagesPath = sprintf(
            '%s/%s/%s/products/%s/',
            $this->homeDir,
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $product->getId_company()),
            $product->getId()
        );

        $cachePath = sprintf(
            '%s/cache/%s/%s/products/%s',
            $this->homeDir,
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $product->getId_company()),
            $product->getId()
        );

        $this->deleteDirectory->__invoke($productsImagesPath);
        $this->deleteDirectory->__invoke($cachePath);

        $this->deleteEntity->__invoke($product);
    }

}
