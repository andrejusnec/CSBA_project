<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductBalance;
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
            AssociationField::new('product_supply')->onlyOnForms()->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            AssociationField::new('product')->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            AssociationField::new('order_id')->onlyOnForms()->setLabel('Order number')->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            AssociationField::new('size')->onlyOnForms()->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            AssociationField::new('color')->onlyOnForms(),
            NumberField::new('quantity'),
            NumberField::new('reserved')
        ];
    }

}
