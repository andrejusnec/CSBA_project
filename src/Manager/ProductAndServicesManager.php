<?php


namespace App\Manager;


use App\Entity\ProductsAndServices;
use App\Repository\ProductsAndServicesRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;

class ProductAndServicesManager
{
    private ProductsAndServicesRepository $repository;
    private ProductBalanceManager $productBalanceManager;

    /**
     * ProductAndServicesManager constructor.
     * @param ProductsAndServicesRepository $repository
     */
    public function __construct(ProductsAndServicesRepository $repository, ProductBalanceManager $productBalanceManager)
    {
        $this->repository = $repository;
        $this->productBalanceManager = $productBalanceManager;
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
                'children' => (new ProductAndServicesManager($this->repository, $this->productBalanceManager))->hierarchy($data[$i]->getId()
                ));
        }
        return $sortedArr;
    }

    public function findCategoryProducts(int $id): array
    {
        return $this->repository->findBy(['isProduct' => true, 'isActive' => true, 'parent' => $id]);
    }

    public function getAllCategoryProducts($id, &$array): void
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

    public function getAllCategories($id, &$array): void
    {
        if(gettype($id) === "string" )
        {
            $id = intval($id);
        }
        $array[] = $id;
        $data = $this->repository->findBy(['isActive' => true, 'parent' => $id, 'isCatalog' => true]);
        foreach ($data as $value) {
                $this->getAllCategories($value->getId(), $array);
        }
    }

    public function findAllProducts(): array
    {
        return $this->repository->findBy(['isProduct' => true]);
    }

    public function findAllProductsWithPagination()
    {
        return $this->repository->findOnlyActiveProductsPagination();
    }


    public function findOne(int $id): ProductsAndServices
    {
        return $this->repository->find($id);
    }

    /**
     * @throws NoResultException|NonUniqueResultException
     */
    public function getProductAmountInStock(ProductsAndServices $product): mixed
    {
        return $this->productBalanceManager->productAmountInStock($product);
    }

    public function getTagsFromListOfProducts(array $listOfProducts): array
    {
        $tags = array();
        foreach ($listOfProducts as $value) {
            $arr = $value->getTags();
            foreach ($arr as $val) {
                $tags[] = $val;
            }
        }
        return array_unique($tags);
    }

    public function getTenRandomProducts(): array
    {
        return $this->repository->findTenProducts();
    }

    public function getTagProductsForPagination($tag): QueryBuilder
    {
        return $this->repository->getTagProductsQuery($tag);
    }

    /**
     * @param string|null $term
     * @return QueryBuilder
     */
    public function findAllWithSearch(?string $term): QueryBuilder
    {
        return $this->repository->findAllProductsWithSearchQueryBuilder($term);
    }

    public function findAllProductsOfCatalog(?string $term, $catalogList)
    {
        return $this->repository->findAllProductsOfCatalog($term, $catalogList);
    }
}