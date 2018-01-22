<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UserBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Component\Translation\IdentityTranslator;
use UserBundle\Entity\User;

class ProfileType extends AbstractType
{
    private $roleHierarchy=[];

    /**
     * UserType constructor.
     * @param $roles
     */
    public function __construct($roles , $translator)
    {
        $this->roleHierarchy = array();
        foreach (array_keys($roles) as $role) {
            $this->roleHierarchy[$translator->trans($role,[],'roles','fr')] = $role;
        }

    }

    /**
     * {@inheritdoc}
     *
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //dump($this->roleHierarchy);die();
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('telephone')
            ->add('email')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
            'constraints' => array(
                new UniqueEntity(array(
                    'entityClass'=>User::class,
                    'fields'  => 'email',
                    'message' => 'Ce email existe déjà'
                ))
            )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }


}