<?php

namespace Tests\integration\services;

use App\services\DeleteEntity;
use App\services\SaveProduct;
use Tests\TestCase;
use \Faker\Generator as Faker;

class CreateProductTest extends TestCase
{
    public function testCreateProduct()
    {
        $faker = $this->getContainer()->get(Faker::class);
        $saveProduct = $this->getContainer()->get(SaveProduct::class);
        $product = $saveProduct([
            'id_company' => self::COMPANY_1_ID,
            'name' => $faker->words(5, true),
            'id_category' => 1,
            'description' => $faker->words(15, true)
        ]);

        $this->assertNotNull($product->getId());

        $deleteEntity = $this->getContainer()->get(DeleteEntity::class);
        $deleteEntity($product);
    }
}
