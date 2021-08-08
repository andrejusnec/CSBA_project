<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Cart;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class CartCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cart::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user', 'User'),
            AssociationField::new('product', 'Product')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder
                    ->andWhere('entity.isActive = :val')
                    ->andWhere('entity.isProduct = :val')
                    ->setParameter('val', true);
            }),
            NumberField::new('Price'),
            NumberField::new('Quantity'),
            NumberField::new('Total'),
        ];
    }
}
