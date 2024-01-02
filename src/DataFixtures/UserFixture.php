<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Enum\RoleEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture extends Fixture {
    public function  load(ObjectManager $manager)
    {
        for ($i = 0 ; $i < 5; $i++){
            $user = new User();
            $faker = Factory::create('fr_FR');
            $user->setEmail($faker->email);
            $user->setPassword("toto");
            $user->setUsername($faker->userName);
            $user->setRole(RoleEnum::USER);
            $manager->persist($user);
        }
        $manager->flush();
    }
}


