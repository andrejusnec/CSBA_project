<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Tag Name'),
            AssociationField::new('productsAndServices', 'Product')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->andWhere('entity.isActive = :val')->andWhere('entity.isProduct = :val')->setParameter('val', true);
            }),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('id')
            ->add('name');
    }
}
