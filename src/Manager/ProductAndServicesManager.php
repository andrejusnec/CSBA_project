<?php


namespace App\Manager;


use App\Repository\ProductsAndServicesRepository;

class ProductAndServicesManager
{
    private ProductsAndServicesRepository $repository;

    /**
     * ProductAndServicesManager constructor.
     * @param ProductsAndServicesRepository $repository
     */
    public function __construct(ProductsAndServicesRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getParentCatalogs(): array
    {
        return $this->repository->getParents();
    }

}