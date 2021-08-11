<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductBalance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ProductBalanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductBalance::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('product_supply')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->andWhere('entity.isActive = :val')->andWhere('entity.status = :val')->setParameter('val', true);
            }),
            AssociationField::new('product')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->andWhere('entity.isActive = :val')->andWhere('entity.isProduct = :val')->setParameter('val', true);
            }),
            AssociationField::new('order_id')->setLabel('Order number')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            AssociationField::new('cart')->onlyOnForms(),
            NumberField::new('quantity'),
            NumberField::new('reserved')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('product_supply')
            ->add('product')
            ->add('order_id')
            ->add('quantity')
            ->add('reserved');
    }

}
