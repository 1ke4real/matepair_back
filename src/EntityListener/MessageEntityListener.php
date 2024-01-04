<?php

namespace App\EntityListener;



use App\Entity\Message;
use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[AsEntityListener(event: 'prePersist', entity: Message::class)]
#[AsEntityListener(event: 'preUpdate', entity: Message::class)]
class MessageEntityListener
{
   public function __invoke(Message $message, LifecycleEventArgs $event): void
   {
       $message->setTimestamp(new \DateTime());
       $entityManager = $event->getEntityManager();
       $notification = new Notification();
       $newUser = $message->getReceiver();
       $notification->setUserId($newUser);
       $notification->setName('Nouveau message');
       $notification->setContent('Vous avez reçu un nouveau message de '.$message->getSender()->getUsername());
       $notification->setTimestamp(new \DateTime());
       $entityManager->persist($notification);
         $entityManager->flush();
   }
}
