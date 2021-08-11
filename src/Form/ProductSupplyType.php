<?php

namespace App\Form;

use App\Entity\ProductSupply;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSupplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('order_number')
            ->add('date')
            ->add('isActive')
            ->add('status')
            ->add('ProductSupplyLists', CollectionType::class, [
                'entry_type' => ProductSupplyListType::class,
                'entry_options' => ['label' => false],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductSupply::class,
        ]);
    }
}
