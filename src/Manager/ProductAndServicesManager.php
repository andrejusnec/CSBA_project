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
    public function getAll() : array
    {
        return $this->repository->findAll();
    }

    public function hierarchy($id = null): array
    {
        if ($id === null) {
            $data = $this->repository->findBy(['isProduct' => false, 'isActive' => true, 'parent' => null]);
        } else {
            $data = $this->repository->findBy(['isProduct' => false, 'isActive' => true, 'parent' => $id]);
        }
        $sortedArr = [];
        for ($i = 0; $i < count($data); $i++) {
            $sortedArr[] = ['category' => $data[$i],
                'children' => (new ProductAndServicesManager($this->repository))->hierarchy($data[$i]->getId()
                )];
        }
        return $sortedArr;
    }
    public function findCategoryProducts(int $id) : array
    {
        return $this->repository->findBy(['isProduct' => true, 'isActive' => true, 'parent' => $id]);
    }
    public function findAllProducts() : array
    {
        return $this->repository->findBy(['isProduct' => true]);
    }
}