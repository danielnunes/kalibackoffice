<?php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('categories', 'entity', array(
            'class' => 'KaliBackProductBundle:Category',
            'property' => 'name',
            'multiple' => true,
            'expanded' => true,
            'label_attr' => array('class' => 'col-sm-2 control-label'),
        ));
    }

    public function getName() {
        return 'categoryProductType';
    }

}
