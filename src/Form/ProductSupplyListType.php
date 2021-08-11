<?php

namespace App\Form;

use App\Entity\ProductsAndServices;
use App\Entity\ProductSupply;
use App\Entity\ProductSupplyList;
use App\Repository\ProductsAndServicesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSupplyListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', NumberType::class)
            ->add('product', EntityType::class, [
                'class' => ProductsAndServices::class,
                'query_builder' => function (ProductsAndServicesRepository $repo) {
                    return $repo->createQueryBuilder('prod')
                        ->andWhere('prod.isActive = :val')
                        ->andWhere('prod.isProduct = :val')
                        ->setParameter('val', true);
                },
                'choice_label' => 'title',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductSupplyList::class,
        ]);
    }
}
