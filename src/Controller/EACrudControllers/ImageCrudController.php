<?php

namespace App\Controller\EACrudControllers;

use App\Controller\Admin\Filter\OnlyProductFilter;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;
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
            TextField::new('title', 'Image title'),
            BooleanField::new('isActive', 'Active'),
            ImageField::new('file_name', 'Image')
                ->onlyOnIndex()
                ->setBasePath('/uploads/images/'),
            TextareaField::new('thumbnail', 'Image')
                ->onlyOnForms()
                ->setFormType(VichImageType::class),
            AssociationField::new('product')->setQueryBuilder(function ($queryBuilder) {
                return $queryBuilder->andWhere('entity.isActive = :val')->andWhere('entity.isProduct = :val')->setParameter('val', true);
            }),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title', 'Image name')
            ->add('isActive')
            ->add(OnlyProductFilter::new('product'));
    }
}
