<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 23/06/16
 * Time: 07:37
 */

namespace Planner\UserBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotEditLastDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $datetime = new \DateTime();
        if($constraint->interval != null) $datetime->modify($constraint->interval);
        $datetime->setTime(0,0,0);
        if($value <= $datetime){
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}