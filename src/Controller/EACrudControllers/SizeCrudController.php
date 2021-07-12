<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Size;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SizeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Size::class;
    }


    public function configureFields(string $pageName): iterable
    {
        {
            return [
                TextField::new('title'),
                BooleanField::new('isActive'),
            ];
        }
    }

}
