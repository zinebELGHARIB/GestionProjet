<?php

namespace Utils\Validators\Constraints;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr;
use PlannerBundle\Entity\Document;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\VarDumper\VarDumper;

class UniqueReferenceValidator extends ConstraintValidator
{

    private $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function validate($value, Constraint $constraint)
    {
        if(null == $constraint->property){
            throw  new \ErrorException("la valeur de l'attribut proprety ne peu être vide");
        }
        // all key will be ignore is set in this
        $ignore = array();

        if(is_array($value)){
            $value = $value["doc"];
        }

        /** @var Document $value */
        $current =$value;

        do{
            if(null!=$current->getId()){
                $ignore[] = $current->getId();
            }
            $current = $current->getMentor();
        }while($current!=null);

        $exp = new Expr();
        $qb = $this->entityManager->getRepository(Document::class)
            ->createQueryBuilder('d');
        $qb
            ->select('count(d)')
            ->where($exp->eq('d.'.$constraint->property,':reference'))
            ->setParameter('reference',call_user_func(array($value,'get'.ucfirst($constraint->property))));

        if(count($ignore) > 0){
            $qb->andWhere($exp->notIn('d.id',':ignore'))
                ->setParameter('ignore',$ignore);
        }
        $count = $qb->getQuery()->getSingleScalarResult();
        if($count > 0){
            $this->context->buildViolation($constraint->message)
                ->atPath($constraint->property)
                ->addViolation();
        }
    }
}