<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('address')->onlyOnForms(),
            AssociationField::new('country')->onlyOnForms()->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            TextField::new('city')->onlyOnForms(),
            TextField::new('post_code')->onlyOnForms(),
            TextField::new('order_number'),
            TimeField::new('date')->setLabel('Time')->onlyOnIndex(),
            DateField::new('date')->onlyOnIndex(),
            BooleanField::new('isActive', 'Active'),
            BooleanField::new('status'),
            AssociationField::new('user', 'User email')->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isVerified = :val')->setParameter('val', true);
            }),
        ];
    }

}
