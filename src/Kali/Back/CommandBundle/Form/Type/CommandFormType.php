<?php

// Kali/Back/ProductBundle/Form/Type/ProductType.php

namespace Kali\Back\CommandBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommandFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('date', 'date', array(
                    'label' => 'Date de commande',
                    'input' => 'datetime',
                    'widget' => 'choice',
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('price', 'number', array(
                    'label' => "Prix (€)",
                    'precision' => 2,
                    'attr' => array('class' => 'form-control'),
                ))
                ->add('sender', 'entity', array(
                    'label' => 'Expéditeur',
                    'class' => 'KaliBackProductBundle:Sender',
                    'property' => 'name',
                    'expanded' => false,
                    'multiple' => false,
                    'attr' => array('class' => 'form-control'),
                ))
                
                ->add('promotion', 'entity', array(
                    'label' => 'Promotion',
                    'class' => 'KaliBackProductBundle:Promotion',
                    'property' => 'value',
                    'expanded' => false,
                    'multiple' => false,
                    'attr' => array('class' => 'form-control'),
                ));
    }

    public function getName() {
        return 'productType';
    }

}
