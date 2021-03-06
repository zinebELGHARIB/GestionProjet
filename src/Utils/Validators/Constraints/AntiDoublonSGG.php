<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 22/06/16
 * Time: 17:24
 */

namespace Planner\UserBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class AntiDoublonSGG extends Constraint
{
    public $message = "IL ne peut avoir deux Sécrétaires generals.";
    public $role="ROLE_SGG_SG";

    public function validatedBy()
    {
        return 'conseil_antidoublon_sgg'; // TODO: Change the autogenerated stub
    }

    /**
     * @return string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}