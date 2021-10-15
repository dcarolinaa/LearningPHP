<?php

namespace App\repositories;

use App\models\ProductCategory;

class ProductCategoriesRepository extends Repository
{

    protected function getClassName(): string
    {
        return ProductCategory::class;
    }
   
}
