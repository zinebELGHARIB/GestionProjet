<?php

namespace Planner\UserBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\VarDumper\VarDumper;

class NowOrFuturDatetimeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $nowDatetime = new \DateTime();
        $nowDatetime->setTime(0,0,0);
        if ($nowDatetime > $value)
        {
            try {
                $formater = new \IntlDateFormatter("fr_FR", \IntlDateFormatter::FULL, \IntlDateFormatter::SHORT);
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%lastDatetime%', $formater->format($value))
                    ->addViolation();
            }catch(\Exception $e) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('%lastDatetime%', $formater->format("d/m/Y"))
                    ->addViolation();
            }
        }
    }
}