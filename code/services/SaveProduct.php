<?php

namespace App\services;

use App\models\Product;
use App\repositories\ProductsRepository;

class SaveProduct
{
    private $saveEntity;
    private $productsRepository;
    private $uploadDir;
    private $pathCompanyLogo;
    private $moveFile;
    private $homeDir;

    public function __construct(
        SaveEntity $saveEntity,
        ProductsRepository $productsRepository,
        MoveFile $moveFile,
        string $uploadDir,
        string $pathCompanyLogo,
        string $homeDir
    ) {
        $this->saveEntity = $saveEntity;
        $this->productsRepository = $productsRepository;
        $this->moveFile = $moveFile;
        $this->uploadDir = $uploadDir;
        $this->pathCompanyLogo = $pathCompanyLogo;
        $this->homeDir = $homeDir;
    }

    public function __invoke($data)
    {
        $image = isset($data['image']) ? $data['image'] : false;
        $this->clearData($data);
        $product = $this->getProduct($data);

        $product->fill([
            'id_company' => $data['id_company'],
            'name' => $data['name'],
            'description' => $data['description'],
            'id_category' => $data['id_category'],
            'create_date' => $data['create_date'],
            'update_date' => $data['update_date']
        ]);

        $this->saveEntity->__invoke($product);

        if ($image) {
            $this->saveImage($image, $product->getId_company(), $product->getId());
        }

        return $product;
    }

    private function clearData(&$data)
    {
        unset($data['image']);
        unset($data['create_date']);
        unset($data['update_date']);
    }

    private function getProduct(&$data)
    {
        $now = date('Y-m-d H:i:s');
        $data['update_date'] = $now;

        if (isset($data['id'])) {
            $product = $this->productsRepository->getById($data['id']);
            $data['create_date']  = $product->getCreate_date();
            unset($data['id']);
        } else {
            $product = new Product();
            $data['create_date'] = $now;
        }

        return $product;
    }

    private function saveImage($image, $idCompany, $idProduct)
    {
        $path = sprintf(
            '%s/%s/products/%s',
            $this->uploadDir,
            sprintf($this->pathCompanyLogo, $idCompany),
            $idProduct
        );
        $this->moveFile->__invoke($image, $path, sprintf('product%s_image.jpg', $idProduct));

        $this->cleanCache($path, $idProduct);
    }

    private function cleanCache($path, $idProduct)
    {
        $cache = sprintf(
            '%s/cache/%s/product%s_image',
            $this->homeDir,
            $path,
            $idProduct
        );

        if (!file_exists($cache)) {
            return;
        }

        foreach (scandir($cache) as $file) {
            $fullFileName = sprintf('%s/%s', $cache, $file);
            if (is_file($fullFileName)) {
                unlink($fullFileName);
            }
        }
    }


}
