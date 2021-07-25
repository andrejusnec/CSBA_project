<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductSupplyList;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ProductSupplyListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductSupplyList::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('product_supply'),
            AssociationField::new('product'),
            AssociationField::new('size'),
            AssociationField::new('color'),
            NumberField::new('quantity')
        ];
    }
}
