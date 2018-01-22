<?php
/**
 * Created by PhpStorm.
 * User: afidoss
 * Date: 22/06/16
 * Time: 17:24
 */

namespace Planner\UserBundle\Validator\Constraints;


use Planner\UserBundle\Entity\Ministere;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\ConstraintValidator;

class AntiDoublonMIValidator extends ConstraintValidator
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
    public function validate($utilisateur, Constraint $constraint)
    {
        if($utilisateur->getRole() == $constraint->role){
            $resultat = $this->entityManager->getRepository("PlannerUserBundle:Utilisateurs")
                ->findByRoleAndMininstere($constraint->role,$utilisateur->getMinistere());
            //dump($resultat); die();
            if(count($resultat)>0){
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }

        }
        
    }

}