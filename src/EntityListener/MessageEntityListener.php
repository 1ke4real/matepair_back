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
        dd($message);
       $notification = new Notification();

       $notification->setUserNotif($message->getReceiver());
       $notification->setContent('Vous avez reçu un nouveau message de ');
       $notification->setTimestamp(new \DateTime());
       dd($notification);

   }
}
