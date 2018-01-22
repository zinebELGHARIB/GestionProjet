<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 28/12/16
 * Time: 14:08
 */

namespace Utils\Handlers;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\PreRemove;
use Symfony\Component\Routing\RequestContext;
use Utils\Traits\Moment;

class MomentInjector
{
    private $dateAtMoment;

    public function __construct()
    {
        $this->dateAtMoment = new \DateTime();
    }


    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->updateMoment($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->updateMoment($entity,false);
    }

    public function updateMoment($entity,$isNewEntity=true){
        if(method_exists($entity,'setUpdatedAt') && method_exists($entity,'setCreatedAt')){
            $entity->setUpdatedAt($this->dateAtMoment);
            if($isNewEntity){
                $entity->setCreatedAt($this->dateAtMoment);
            }
        }
    }


}