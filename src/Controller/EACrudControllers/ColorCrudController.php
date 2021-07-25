<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Color;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ColorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Color::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            BooleanField::new('isActive'),
        ];
    }
}
