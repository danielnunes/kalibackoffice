<?php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SenderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array(
                    'label' => "Name",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('maxSize', 'integer', array(
                    'label' => "Taille maximale (cm)",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('maxWeight', 'integer', array(
                    'label' => "Poids maximale (g)",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('price', 'number', array(
                    'label' => "Prix",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ));
    }

    public function getName() {
        return 'senderType';
    }

}
