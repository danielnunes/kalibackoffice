<?php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CaracteristicType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array(
                    'label' => "Nom",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ));
    }

    public function getName() {
        return 'caracteristicType';
    }

}
