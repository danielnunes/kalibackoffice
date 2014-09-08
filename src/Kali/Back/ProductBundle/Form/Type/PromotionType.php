<?php

// Kali/BackBundle/Form/Type/PromotionType.php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PromotionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('value', 'integer', array(
                    'label' => "Pourcentage de réduction",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ));
    }

    public function getName() {
        return 'promotionType';
    }

}
