<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            BooleanField::new('isActive'),
            ImageField::new('file_name', 'Image')
//                ->setBasePath('%uploads_path%')
                ->onlyOnIndex()
                ->setBasePath('/uploads/images/'),
            TextareaField::new('thumbnail', 'Image')
                ->onlyOnForms()
                ->setFormType(VichImageType::class),
            AssociationField::new('product'),
        ];
    }

//    public function configureCrud(Crud $crud): Crud
//    {
//        return $crud->setFormOptions()
//            // the labels used to refer to this entity in titles, buttons, etc.
//            ->setEntityLabelInSingular('P222')
//            ->showEntityActionsAsDropdown()
//            ->setEntityLabelInPlural('222');
//    }
}
