<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductSupply;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ProductSupplyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductSupply::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('order_number'),
            BooleanField::new('isActive'),
            TimeField::new('date')->setLabel('Time')->onlyOnIndex(),
            DateField::new('date')->onlyOnIndex(),
            BooleanField::new('status')
        ];
    }
}
