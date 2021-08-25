<?php

namespace App\services;

use App\models\Dish;

class CreateDish
{
    private $saveEntity;

    public function __construct(SaveEntity $saveEntity)
    {
        $this->saveEntity = $saveEntity;
    }

    public function __invoke($data)
    {
        $dish = new Dish();
        $dish->fill([
            'id_company' => $data['id_company'],
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        $this->saveEntity->__invoke($dish);
        return $dish;
    }
}
