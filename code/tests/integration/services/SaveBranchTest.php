<?php

namespace Tests\integration\services;

use App\repositories\BranchesRepository;
use \Faker\Generator as Faker;
use App\services\SaveBranch;
use Tests\TestCase;

class SaveBranchTest extends TestCase
{
    public function testSaveBranchTest(): void
    {
        $faker = $this->getContainer()->get(Faker::class);
        $branchesRepostory = $this->getContainer()->get(BranchesRepository::class);
        $branch = $branchesRepostory->getLastInserted();
        
        $nuevoNombre = $faker->company();
        $slugAnterior = $branch->getSlug();

        $this->assertNotSame($nuevoNombre,$branch->getName());
        $this->assertSame($slugAnterior,$branch->getSlug());        

        $saveBranch = $this->getContainer()->get(SaveBranch::class);

        $branchModified = $saveBranch([
            'id' => $branch->getId(),
            'name' => $nuevoNombre,
            'address' => $faker->streetAddress,
            'telephone' => $faker->randomNumber(6),
            'cellphone' => $faker->randomNumber(6),
            'email' => $faker->email,
            'lat' => $faker->latitude(),
            'lng' => $faker->longitude(),

        ]);

        $this->assertNotEquals($branch, $branchModified);
        $this->assertSame($nuevoNombre,$branchModified->getName());
        $this->assertNotSame($slugAnterior,$branchModified->getSlug());

        $saveBranch([
            'id' => $branch->getId(),
            'name' => $branch->getName(),
            'address' => $branch->getAddress(),
            'telephone' => $branch->getTelephone(),
            'cellphone' => $branch->getCellphone(),
            'email' => $branch->getEmail(),
            'lat' => $branch->getLat(),
            'lng' => $branch->getLng(),

        ]);

    }
}
