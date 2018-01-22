<?php
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 5/19/17
 * Time: 11:36 AM
 */

namespace Utils;


use CarteBundle\Entity\Etape;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ActionData implements \Iterator
{
    private static $actiondata;


    /**
     * @return Etape
     */
    public static function getActionFor($id = "1")
    {
        $action = new Etape();
        $action->setLibelle(ActionData::getActiondata()[$id]["lib"]);
        $action->setIsPositive(ActionData::getActiondata()[$id]["pos"]);
        $action->setLibelleDisplay(ActionData::getActiondata()[$id]["disp"]);
        $action->setHasNotification(ActionData::getActiondata()[$id]["notif"]);
        $action->setHasObservation(ActionData::getActiondata()[$id]["obser"]);

        return $action;
    }

    /**
     * @return mixed
     */
    public static function getActiondata()
    {
        $actiondata["1"] = array("lib" => "FILE_SAVED", "disp" => "Dossier enregistré", "obser" => false, "notif" => true, "pos" => true);
        $actiondata["2"] = array("lib" => "FILE_REJECTED", "disp" => "Dossier rejeté", "obser" => true, "notif" => true, "pos" => false);
        $actiondata["3"] = array("lib" => "FILE_ACCEPTED", "disp" => "Dossier accepté", "obser" => true, "notif" => true, "pos" => true);
        $actiondata["4"] = array("lib" => "CARD_PRINTED", "disp" => "Validé(e) par le SGM.", "obser" => true, "notif" => true, "pos" => true);

        return $actiondata;
    }


    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

}