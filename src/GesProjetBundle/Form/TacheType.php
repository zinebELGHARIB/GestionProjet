<?php

namespace GesProjetBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('refTache')
            ->add('designTache')
            ->add('debutTache',\Symfony\Component\Form\Extension\Core\Type\DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => ['class' => 'js-datepicker startDate'],
                "required" => true
            ))
            ->add('finTache',\Symfony\Component\Form\Extension\Core\Type\DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => ['class' => 'js-datepicker startDate'],
                "required" => true
            ))
            ->add('etat',ChoiceType::class, array(
                'choices'   => array(
                    'Pas Commencé'   => 'Pas Commencé',
                    'En Cours'   => 'En Cours',
                    'Fait'        => 'Fait',
                    'En Retard'=>'En Retard',
                ),)  )
            ->add('projet',EntityType::class,[
                'class'=>'GesProjetBundle:Projet',
            ])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GesProjetBundle\Entity\Tache'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gesprojetbundle_tache';
    }


}
