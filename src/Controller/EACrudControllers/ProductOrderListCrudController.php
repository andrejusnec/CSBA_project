<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductOrderList;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ProductOrderListCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductOrderList::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('order_id')->onlyOnForms(),
            AssociationField::new('product'),
            NumberField::new('quantity'),
            NumberField::new('price'),
            NumberField::new('total'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('order_id')
            ->add('product')
            ->add('quantity')
            ->add('price')
            ->add('total');
    }

}
