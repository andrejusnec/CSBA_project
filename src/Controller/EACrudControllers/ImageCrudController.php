<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('file_name')->setLabel('File Path'),
            TextField::new('title'),
            BooleanField::new('isActive'),
            AssociationField::new('product')
        ];
    }

//    public function configureCrud(Crud $crud): Crud
//    {
//        return $crud
//            // the labels used to refer to this entity in titles, buttons, etc.
//            ->setEntityLabelInSingular('P222')
//            ->showEntityActionsAsDropdown()
//            ->setEntityLabelInPlural('222');
//    }
}
