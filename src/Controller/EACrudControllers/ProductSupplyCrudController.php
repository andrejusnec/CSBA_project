<?php

namespace App\Controller\EACrudControllers;

use App\Entity\ProductSupply;
use App\Entity\ProductSupplyList;
use App\Form\ProductSupplyListType;
use App\Form\Type\CollectionComplexType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ProductSupplyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductSupply::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setSearchFields(['order_number', 'isActive']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Product Supply'),
            TextField::new('order_number'),
            TimeField::new('date')->setLabel('Time')->hideOnForm(),
            DateField::new('date')->hideOnForm(),

            BooleanField::new('isActive'),
            BooleanField::new('status'),

            FormField::addPanel('Product Supply Items'),
            CollectionField::new('productSupplyLists', 'Product Supply Lists')
                ->setFormTypeOptions([
                    'entry_type' =>ProductSupplyListType::class,
                    'by_reference' => false,
                    'allow_add' => true,
                    'attr' => ['class' => 'form-group']])
                ->setEntryIsComplex(true)->hideOnIndex(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
