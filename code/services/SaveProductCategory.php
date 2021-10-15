<?php

namespace App\services;

use App\models\ProductCategory;
use App\repositories\ProductCategoriesRepository;

class SaveProductCategory
{
    private $saveEntity;
    private $productCategoriesRepository;

    public function __construct(
        SaveEntity $saveEntity,
        ProductCategoriesRepository $productCategoriesRepository
    )
    {
        $this->saveEntity = $saveEntity;
        $this->productCategoriesRepository = $productCategoriesRepository;
        
    }

    public function __invoke($data)
    {        
        unset($data['create_date']);
        $productCategory = $this->getProductCategory($data);
        $productCategory->fill([
            'name' => $data['name'],
            'id_company' => $data['id_company'],
            'create_user' => $data['create_user'],
            'create_date' => $data['create_date']
        ]);
        
        $this->saveEntity->__invoke($productCategory);
        return $productCategory;
    }

    private function getProductCategory(&$data)
    {
        $now = date('Y-m-d H:i:s');

        if (isset($data['id'])) {
            $productCategory = $this->productCategoriesRepository->getById($data['id']);
            $data['create_date']  = $productCategory->getCreate_date();
            unset($data['id']);
        } else {
            $productCategory = new ProductCategory();
            $data['create_date'] = $now;
        }

        return $productCategory;
    }
}
