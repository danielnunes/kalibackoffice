<?php

namespace Kali\Back\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;


/**
 * The form on registration page
 */
class ClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 'choice', array(
                'choices' => array('m' => 'Masculin', 'f' => 'Feminin'),
                'required' => false,
                'label' => 'Sexe',
                'attr' => array('class' => 'form-control')
            ))
            ->add('lastName', 'text', array(
                    'constraints' => new NotBlank(),
                    'label' => 'Nom',
                'attr' => array('class' => 'form-control'))
            )
            ->add('firstName', 'text', array(
                    'constraints' => new NotBlank(),
                    'label' => 'Prénom',
                'attr' => array('class' => 'form-control'))
            )
            ->add('birthDate', 'birthday', array(
                'years' => range(date('Y') - 100, date('Y') - 16),
                'empty_value' => array(
                    'year' => 'Année',
                    'month' => 'Mois',
                    'day' => 'Jour',
                ),
                'required' => true,
                'constraints' => new NotBlank(),
                'label' => 'Date de naissance',
                'attr' => array('class' => 'form-control')
            ))
            ->add('address', 'text', array(
                    'constraints' => new NotBlank(),
                    'label' => 'Adresse',
                'attr' => array('class' => 'form-control'))
            )
            ->add('city', 'text', array('label' => 'Ville',
                'attr' => array('class' => 'form-control')))
            ->add('postalCode', 'text', array('label' => 'Code postal',
                'attr' => array('class' => 'form-control')))
            ->add('phone', 'text', array('label' => 'Numéro de téléphone',
                'attr' => array('class' => 'form-control')))
            ->add('mobilePhone', 'text', array('label' => 'Numéro de mobile',
                'attr' => array('class' => 'form-control')));
    }

    public function getName()
    {
        return 'kali_back_client';
    }
}