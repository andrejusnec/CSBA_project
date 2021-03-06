<?php

namespace App\Controller\EACrudControllers;

use App\Entity\WishList;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class WishListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WishList::class;
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
            })
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('user')
            ->add('product');
    }
}
