<?php

namespace Tests\integration\services;
use App\services\CreateUser;
use App\repositories\UsersRepository;
use \Faker\Generator as Faker;
use Tests\TestCase;


class CreateUserTest extends TestCase
{

    public function testCreateUser()
    {
        $faker = $this->getContainer()->get(Faker::class);
        $birthdate = $faker->dateTimeBetween('-30 days', '+30 days');

        $createUserService = $this->getContainer()->get(CreateUser::class);
        $userRepository = $this->getContainer()->get(UsersRepository::class);

        $email = $faker->email;

        $user = $createUserService([
            'first_name' => 'Admin2',
            'last_name' => 'SuperAdmin2',
            'birthdate' => $birthdate->format('Y-m-d'),
            'email' => $email,
            'username' => 'Admin2',
            'password' => 'Admin123'
        ]);

        $userDb = $userRepository->getByEmail($email);
        $this->assertEquals($userDb, $user); //Evalua todos los atributos del objeto
        //$this->assertSame($userDb, $user);

        /*
            $u = clone $userDb;
            $this->assertEquals($userDb, $u);
            $this->assertSame($userDb, $u);
        */
    }
}
