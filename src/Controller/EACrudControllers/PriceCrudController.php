<?php

namespace App\Controller\EACrudControllers;

use App\Entity\Price;
use App\Repository\ProductsAndServicesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PriceCrudController extends AbstractCrudController
{
    private ProductsAndServicesRepository $repo;

    /**
     * PriceCrudController constructor.
     * @param ProductsAndServicesRepository $repo
     */
    public function __construct(ProductsAndServicesRepository $repo)
    {
        $this->repo = $repo;
    }

    public static function getEntityFqcn(): string
    {
        return Price::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('price'),
            AssociationField::new('product')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->andWhere('entity.isProduct = :val')->andWhere('entity.isActive = :val')->setParameter('val', true);
            }),
            DateField::new('period')->setFormat("yyyy-MM-dd")
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('price')
            ->add('product')
            ->add('period');
    }
}
