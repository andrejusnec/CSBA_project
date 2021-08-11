<?php

namespace App\Controller\EACrudControllers;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $choises = ['Admin' => 'ROLE_ADMIN', 'Manager' => 'ROLE_MANAGER'];
        return [
            TextField::new('getFullName', 'Full Name')->onlyOnIndex(),
            TextField::new('first_name')->hideOnIndex(),
            TextField::new('last_name')->hideOnIndex(),
            EmailField::new('email'),
            TextField::new('phone'),
            ChoiceField::new('roles')
                ->autocomplete()
                ->allowMultipleChoices()
                ->setChoices($choises),
            BooleanField::new('isVerified'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsAsDropdown();
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('email')
            ->add('first_name')
            ->add('phone')
            ->add('isVerified')
            ->add(ArrayFilter::new('roles'));
    }

}
