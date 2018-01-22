<?php
namespace Planner\UserBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class NowOrFuturDatetime extends Constraint
{
public $message = 'Impossible d\'effectuer une opération sur une date anterieur: " %lastDatetime% ".';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}