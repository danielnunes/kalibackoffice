<?php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CaracteristicProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('caracteristics', 'entity', array(
            'class' => 'KaliBackProductBundle:Caracteristic',
            'property' => 'name',
            'multiple' => true,
            'expanded' => true,
            'label_attr' => array('class' => 'col-sm-2 control-label'),
        ));
    }

    public function getName() {
        return 'caracteristicProductType';
    }

}
