<?php
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 4/26/17
 * Time: 12:47 PM
 */

namespace Utils;


use CarteBundle\Entity\Etape;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Yaml;

class Utils extends Controller
{
    /**
     * @return mixed
     */
    public static function getLibUnique($container, $id = 0)
    {
        $etapes = Yaml::parse(file_get_contents($container->getParameter('link_file_action_yml')));

        $allKeys = array_keys($etapes);

        return $allKeys[$id];
    }


    public static function getLibDisplay($container, $id = 0)
    {
        $etapes = Yaml::parse(file_get_contents($container->getParameter('link_file_action_yml')));

        $allKeys = array_keys($etapes);

        return $etapes[$allKeys[$id]];
    }

    public static function createOrRetrieveAction(ObjectManager $em, Etape $etape)
    {
        $ret = null;

        if ($etape != null && $em != null) {

            $criteria = array("libelle" => $etape->getLibelle());

            $found = $em->getRepository("CarteBundle:Etape")->findOneBy($criteria);

            if ($found != null) {
                $ret = $found;
                $ret->setLibelle($etape->getLibelle());
                $ret->setIsPositive($etape->getIsPositive());
                $ret->setLibelleDisplay($etape->getLibelleDisplay());
                $ret->setHasNotification($etape->getHasNotification());
                $ret->setHasObservation($etape->getHasObservation());

                $em->persist($ret);
                $em->flush($ret);
            } else {
                $em->persist($etape);
                $em->flush($etape);

                $ret = $etape;
            }
        }

        return $ret;
    }

}