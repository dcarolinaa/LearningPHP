<?php

namespace Tests\integration\services;

use App\repositories\CompaniesRepository;
use App\services\CreateBranch;
use Tests\TestCase;
use \Faker\Generator as Faker;

final class CreateBranchTest extends TestCase{
    /*
    return [
            'id',
            'id_company',
            'name',
            'address',
            'telephone',
            'cellphone',
            'email'
        ];
    
    */

    public function testCreateBranch(){
        $createBranch = $this->getContainer()->get(CreateBranch::class);
        $faker = $this->getContainer()->get(Faker::class);
        $companiesRepository = $this->getContainer()->get(CompaniesRepository::class);
        $company = $companiesRepository->getByCompanyName('Sushi Go!');

        $branch = $createBranch(
            [                
                'id_company' => $company->getId(),
                'name' => $faker->company,
                'address' => $faker->streetAddress,
                'telephone' => $faker->randomNumber(6),
                'cellphone' => $faker->randomNumber(6),            
                'email' => $faker->email
            ]
        );
            
        $this->assertNotNull($branch->getId());
    }

}