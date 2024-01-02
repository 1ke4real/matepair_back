<?php

namespace App\DataFixtures;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $getUsers = $manager->getRepository(User::class)->findAll();
       for ($i = 0 ; $i < 5; $i++){
           $sender = $getUsers[array_rand($getUsers)];
           do {
               $receiver = $getUsers[array_rand($getUsers)];
           } while ($receiver === $sender);
           $message = new Message();
           $faker = Factory::create('fr_FR');
           $message->setSender($sender);
           $message->setReceiver($receiver);
           $message->setTimestamp($faker->dateTime);
           $message->setContent('iufshifheih');
           $manager->persist($message);
       }
    $manager->flush();
    }
}
