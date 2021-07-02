<?php

namespace App\fixtures;

use App\services\CreateBranch;
use Tests\TestCase;
use Faker\Generator as Faker;

class Branches{

    public function build(CreateBranch $createBranch, Faker $faker ){
        $createBranch(
            [                
                'id_company' => TestCase::COMPANY_1_ID,
                'name' => 'Sushi Go! Matriz',
                'address' => $faker->streetAddress,
                'telephone' => $faker->randomNumber(6),
                'cellphone' => $faker->randomNumber(6),            
                'email' => $faker->email
            ]
        );
    }

}