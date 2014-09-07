<?php

namespace Kali\Back\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Email'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation'),
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
            ))
            ->add('roles', 'collection', array(
                    'type' => 'choice',
                    'options' => array(
                        'label' => false,
                        'choices' => array(
                            'ROLE_ADMIN' => 'Admin',
                            'ROLE_SERVICE_CLIENT' => 'Service Client',
                            'ROLE_SERVICE_PRODUCT' => 'Service Produit',
                            'ROLE_USER' => 'Utilisateur'
                        )
                    )
                )
            );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kali_back_userbundle_user';
    }
}