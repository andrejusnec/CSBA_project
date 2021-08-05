<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductsAndServices;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductsAndServicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductsAndServices::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            BooleanField::new('isProduct') ,
            BooleanField::new('isActive'),
            BooleanField::new('isCatalog'),
            AssociationField::new('measure_code')->onlyOnForms()->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            AssociationField::new('parent'),
            TextField::new('fontawesome_icon')->onlyOnForms(),
            AssociationField::new('main_image')->onlyOnForms()->onlyOnForms()->setQueryBuilder(function($queryBuilder){
                return $queryBuilder->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
        ];
    }
}
