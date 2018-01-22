<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 04/09/2017
 * Time: 19:37
 */

namespace Utils\Traits;


use Doctrine\ORM\EntityManager;
use FOS\JsRoutingBundle\Controller\Controller;
use NotificationBundle\Entity\UserDocumentNotification;
use PlannerBundle\Entity\Document;
use UserBundle\Entity\User;
use Utils\Interfaces\ArraybleInterface;

/**
 * Trait NotificationControllerTrait
 * @package Utils\Traits
 *
 */
Trait NotificationControllerTrait
{
    /**
     * @param User $user
     * @param array $object
     */
    public function notify(User $user,array $object){
        $notifier = $this->get($this->getParameter('service_notify'));
        $notifier->push(
            $object,
            'channel_web_notification',
            ['username' => $user->getUsername() ]
        );
    }

    /**
     * @param array $object
     */

    public function ownerNotify(array $object){
        $notifier = $this->get($this->getParameter('service_notify'));
        $notifier->push(
            $object,
            'channel_web_notification',
            ['username' => $this->getUser()->getUsername() ]
        );
    }

    /**
     * @param User[] $users
     * @param array $object
     */

    public function notifies(array $users,UserDocumentNotification $documentNotification){
        foreach ($users as $user){
            $notification = $documentNotification->create()->setUser($user);
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();
            $this->notify($user,$notification->toArray());
        }
    }

    private function createNotification($subject,$content,$link,Document $document=null){
        $notification = new UserDocumentNotification();
        $notification->setSubject($subject);
        $notification->setContent($content);
        $notification->setLink($link);
        $notification->setDocument($document);
        /** @var EntityManager $em */
        return $notification;

    }
}