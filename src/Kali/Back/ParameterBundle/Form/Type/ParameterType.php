<?php

namespace Kali\Back\ParameterBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ParameterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('slogan', 'text', array(
                    'label' => "Slogan",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('description', 'textarea', array(
                    'label' => "Description",
                    'required' => false,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('adresse', 'textarea', array(
                    'label' => "Description",
                    'required' => false,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'attr' => array('class' => 'form-control'),
                ));
        /*
                ->add('panier', 'checkbox', array(
                    'label'     => 'Panier',
                    'required'  => false,
                ));
       */

    }

    public function getName() {
        return 'parameterType';
    }

}
