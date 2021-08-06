<?php

namespace App\Manager;

use App\Entity\ProductBalance;
use App\Entity\ProductSupply;
use App\Repository\ProductBalanceRepository;
use App\Service\SumHelper;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use function PHPUnit\Framework\isInstanceOf;

class ProductBalanceManager
{
private ProductBalanceRepository $repository;
private SumHelper $sumHelper;

    /**
     * @param ProductBalanceRepository $repository
     */
    public function __construct(ProductBalanceRepository $repository, SumHelper $sumHelper)
    {
        $this->repository = $repository;
        $this->sumHelper = $sumHelper;
    }

    public function createProductBalance($movementAction, $productSupplyList): ProductBalance
    {
        $productSupply = $movementAction instanceof ProductSupply;
        $productBalance = new ProductBalance();
        $productBalance->setProductSupply(true === $productSupply ? $movementAction : null );
        $productBalance->setOrderId(false === $productSupply ? $movementAction : null );
        $productBalance->setReserved(0);
        $productBalance->setProduct($productSupplyList->getProduct());
        $productBalance->setQuantity(false === $productSupply ? -$productSupplyList->getQuantity() : $productSupplyList->getQuantity());
        return $productBalance;
    }

    /**
     * @throws NonUniqueResultException|NoResultException
     */
    public function productAmountInStock($product): mixed
    {
        return $this->repository->countProductBalance($product);
    }
}