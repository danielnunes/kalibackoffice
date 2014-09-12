<?php

namespace Kali\Back\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Kali\Back\UserBundle\Form\Type\ClientFormType;

/**
 * The form on registration page
 */
class ClientUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('client', new ClientFormType(), array(
            'mapped' => false,
                
                
        ))
            ->add('email', 'email', array('label' => 'Email',
                'attr' => array('class' => 'form-control'),))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                
                'first_options' => array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control'),),
                'second_options' => array('label' => 'Confirmation', 'attr' => array('class' => 'form-control'),),
                'invalid_message' => 'Les mots de passe ne correspondent pas.'
            ));
            
    }

    public function getName()
    {
        return 'kali_back_client_user';
    }
}