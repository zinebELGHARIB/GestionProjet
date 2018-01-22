<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 22/06/16
 * Time: 17:24
 */

namespace Planner\UserBundle\Validator\Constraints;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\ConstraintValidator;

class AntiDoublonDateValidator extends ConstraintValidator
{
    private $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if(null == $constraint->property){
            throw  new \ErrorException("la valeur de l'attribut proprety ne peu être vide");
        }
        if($value->getId() == null){
            $getter="get".ucfirst($constraint->property);
            $initDate = clone  $value->$getter();
            $endDate = clone $value->$getter();
            $initDate->setTime(0,0,0);
            $endDate->setTime(23,59,59);
            $qb = $this->entityManager->getRepository(get_class($value))->createQueryBuilder('c');
            $result=$qb->select("count(c.".$constraint->property.") ")
                ->where($qb->expr()->between("c.".$constraint->property,":init",":end"))
                ->setParameters([":init"=>$initDate,":end"=>$endDate])
                ->getQuery()
                ->getSingleScalarResult();
            if($result > 0)
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
        }
    }

}