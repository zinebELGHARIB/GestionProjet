<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 22/06/16
 * Time: 17:24
 */

namespace Planner\UserBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class NotEditLastDate extends Constraint
{
    public $message = "impossible d'effectuer cette opération";
    public $interval;
}