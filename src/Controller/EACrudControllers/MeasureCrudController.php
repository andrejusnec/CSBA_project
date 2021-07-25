<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Measure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MeasureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Measure::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('code'),
            TextField::new('short_name')->setLabel('Shortcut'),
            TextField::new('full_name')->setLabel('Full name')
        ];
    }

}
