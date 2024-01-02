<?php

namespace App\DataFixtures;

use App\Entity\Encounter;
use App\Entity\User;
use App\Enum\StatusTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class EncounterFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $getUsers = $manager->getRepository(User::class)->findAll();
        for ($i = 0; $i < 5; $i++) {
            $firstMatch = $getUsers[array_rand($getUsers)];
            do {
                $secondMatch = $getUsers[array_rand($getUsers)];
            } while ($firstMatch === $secondMatch);
            $encounter = new Encounter();
            $encounter->addMatch($firstMatch);
            $encounter->addMatch($secondMatch);
            $encounter->setStatus(StatusTypeEnum::WAITING);
            $manager->persist($encounter);
        }
        $manager->flush();
    }

}
