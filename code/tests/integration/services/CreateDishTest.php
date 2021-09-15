<?php

namespace Tests\integration\services;

use App\services\DeleteEntity;
use App\services\SaveDish;
use Tests\TestCase;
use \Faker\Generator as Faker;

class CreateDishTest extends TestCase
{
    public function testCreateDish()
    {
        $faker = $this->getContainer()->get(Faker::class);
        $saveDish = $this->getContainer()->get(SaveDish::class);
        $dish = $saveDish([
            'id_company' => self::COMPANY_1_ID,
            'name' => $faker->words(5, true),
            'description' => $faker->words(15, true)
        ]);

        $this->assertNotNull($dish->getId());

        $deleteEntity = $this->getContainer()->get(DeleteEntity::class);
        $deleteEntity($dish);
    }
}
