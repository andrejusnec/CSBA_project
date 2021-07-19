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
            AssociationField::new('product_supply')->onlyOnForms(),
            AssociationField::new('product'),
            AssociationField::new('order_id')->onlyOnForms()->setLabel('Order number'),
            AssociationField::new('size')->onlyOnForms(),
            AssociationField::new('color')->onlyOnForms(),
            NumberField::new('quantity'),
            NumberField::new('reserved')
        ];
    }

}
