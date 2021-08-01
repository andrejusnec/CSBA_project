<?php


namespace App\Manager;


use App\Entity\ProductsAndServices;
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

    public function getAll(): array
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
            $sortedArr[] = array('category' => $data[$i],
                'children' => (new ProductAndServicesManager($this->repository))->hierarchy($data[$i]->getId()
                ));
        }
        return $sortedArr;
    }

    public function findCategoryProducts(int $id): array
    {
        return $this->repository->findBy(['isProduct' => true, 'isActive' => true, 'parent' => $id]);
    }

    public function getAllCategoryProducts($id, &$array) : void
    {
        $data = $this->repository->findBy(['isActive' => true, 'parent' => $id]);
        foreach ($data as $value) {
            //$array[] = $value;
            if ($value->getIsCatalog()) {
                $this->getAllCategoryProducts($value->getId(), $array);
            } elseif ($value->getIsProduct()) {
                $array[] = $value;
            }
        }
    }

    public function findAllProducts(): array
    {
        return $this->repository->findBy(['isProduct' => true]);
    }

    public function findOne(int $id): ProductsAndServices
    {
        return $this->repository->find($id);
    }
}