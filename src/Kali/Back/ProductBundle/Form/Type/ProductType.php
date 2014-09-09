<?php

// Kali/Back/ProductBundle/Form/Type/ProductType.php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', 'text', array(
                    'label' => "Nom",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('description', 'textarea', array(
                    'label' => "Description",
                    'required' => false,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('price', 'number', array(
                    'label' => "Prix (€)",
                    'precision' => 2,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('lenght', 'number', array(
                    'label' => "Longueur (cm)",
                    'precision' => 2,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('width', 'number', array(
                    'label' => "Largeur (cm)",
                    'precision' => 2,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('density', 'number', array(
                    'label' => "Épaisseur (cm)",
                    'precision' => 2,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('weight', 'number', array(
                    'label' => "Poids (kg)",
                    'precision' => 2,
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('stock', 'integer', array(
                    'label' => "Stock",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                ))
                ->add('ecoParticipation', 'checkbox', array(
                    'label' => "Eco participation",
                    'label_attr' => array('class' => 'col-sm-2 control-label'),
                    'required' => false,
        ));
    }

    public function getName() {
        return 'productType';
    }

}
