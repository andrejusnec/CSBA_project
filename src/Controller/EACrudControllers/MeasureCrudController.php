<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Measure;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;

class MeasureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Measure::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('code', 'International code'),
            TextField::new('short_name')->setLabel('Shortcut'),
            TextField::new('full_name')->setLabel('Full name')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('code')
            ->add('full_name');
    }
}
