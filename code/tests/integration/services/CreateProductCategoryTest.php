<?php

namespace Tests\integration\services;

use App\repositories\UsersRepository;
use App\services\SaveProductCategory;
use \Faker\Generator as Faker;
use Tests\TestCase;

class CreateProductCategoryTest extends TestCase
{
    public function testCreateCategory()
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
    }
}
