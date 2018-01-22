<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 22/06/16
 * Time: 17:24
 */

namespace Planner\UserBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class AntiDoublonDate extends Constraint
{
    public $message = "cette date existe dejà";
    public $property;

    public function validatedBy()
    {
        return 'conseil_antidoublon_date';
    }

    /**
     * @return string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}