<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CountryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')->onlyOnIndex()->setLabel('Country'),
            CountryField::new('title')->onlyOnForms(),
            BooleanField::new('isActive')->setLabel('Active')
        ];
    }
}
