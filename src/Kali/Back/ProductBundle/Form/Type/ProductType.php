<?php

// Kali/Back/ProductBundle/Form/Type/ProductType.php

namespace Kali\Back\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => "Nom",
            'label_attr' => array('class' => 'col-sm-2 control-label'),
            'attr' => array('class' => 'form-control'),
        ))
            ->add('description', 'textarea', array(
                'label' => "Description",
                'required' => false,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('price', 'number', array(
                'label' => "Prix (€)",
                'precision' => 2,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('lenght', 'number', array(
                'label' => "Longueur (cm)",
                'precision' => 2,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('width', 'number', array(
                'label' => "Largeur (cm)",
                'precision' => 2,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('density', 'number', array(
                'label' => "Épaisseur (cm)",
                'precision' => 2,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('weight', 'number', array(
                'label' => "Poids (kg)",
                'precision' => 2,
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('stock', 'integer', array(
                'label' => "Stock",
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'attr' => array('class' => 'form-control'),
            ))
            ->add('ecoParticipation', 'checkbox', array(
                'label' => "Eco participation",
                'label_attr' => array('class' => 'col-sm-2 control-label'),
                'required' => false,
            ));
    }

    public function getName()
    {
        return 'productType';
    }

}
