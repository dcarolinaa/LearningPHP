<?php

namespace App\fixtures;

use App\services\CreateBranch;
use App\services\GenerateSlug;
use Tests\TestCase;
use Faker\Generator as Faker;

class Branches
{

    public function build(
        CreateBranch $createBranch,
        Faker $faker,
        GenerateSlug $generateSlug
    ) {
        $branchName = 'Sushi Go! Matriz';
        $createBranch(
            [
                'id_company' => TestCase::COMPANY_1_ID,
                'name' => $branchName,
                'slug' => $generateSlug($branchName),
                'address' => $faker->streetAddress,
                'telephone' => $faker->randomNumber(6),
                'cellphone' => $faker->randomNumber(6),
                'email' => $faker->email,
                'lat' => $faker->latitude(),
                'lng' => $faker->longitude(),
            ]
        );
    }

}
