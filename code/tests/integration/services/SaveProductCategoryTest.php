<?php

namespace Tests\integration\services;

use App\repositories\UsersRepository;
use App\services\SaveProductCategory;
use \Faker\Generator as Faker;
use Tests\TestCase;

class SaveProductCategoryTest extends TestCase
{
    public function testSaveCategory()
    {
        $faker = $this->getContainer()->get(Faker::class);
        $saveProductCategory = $this->getContainer()->get(SaveProductCategory::class);
        $userRepository = $this->getContainer()->get(UsersRepository::class);
        $admin = $userRepository->getByEmail(self::ADMIN_COMPANY_1);
        
        $productCategory = $saveProductCategory([
            'name' => $faker->realText(20,2),
            'id_company' => self::COMPANY_1_ID,
            'create_user' => $admin->getId(),
            'create_date' => date('Y-m-d H:i:s')
        ]);

        $this->assertNotNull($productCategory->getId());

        $nuevoNombre = $faker->realText(20,2);
        $this->assertNotSame($productCategory->getName(), $nuevoNombre);

        $productCategoryModified = $saveProductCategory([
            'id' => $productCategory->getId(),
            'name' => $nuevoNombre,
            'id_company' => self::COMPANY_1_ID,
            'create_user' => $admin->getId(),
            'create_date' => date('Y-m-d H:i:s')
        ]);

        $this->assertNotEquals($productCategory, $productCategoryModified);
        $this->assertSame($nuevoNombre, $productCategoryModified->getName());
        
        $saveProductCategory([
            'id' => $productCategory->getId(),
            'name' => $productCategory->getName(),
            'id_company' => $productCategory->getId_company(),
            'create_user' => $productCategory->getCreate_user(),
            'create_date' => $productCategory->getCreate_date(),
        ]);

        $this->assertNotSame($productCategory->getName(), $nuevoNombre);
    }
}
