<?php

// Kali/BackBundle/Form/Type/PictureType.php

namespace Kali\BackBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PictureType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array(
                    'label' => "Title",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('file', 'file', array(
                    'label' => "Image",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ));
    }

    public function getName() {
        return 'pictureType';
    }

}
