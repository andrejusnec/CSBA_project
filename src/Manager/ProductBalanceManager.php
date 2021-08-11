<?php

namespace App\Manager;

use App\Entity\Cart;
use App\Entity\ProductBalance;
use App\Repository\ProductBalanceRepository;
use App\Service\SumHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class ProductBalanceManager
{
    private ProductBalanceRepository $repository;
    private SumHelper $sumHelper;
    private EntityManagerInterface $em;

    /**
     * @param ProductBalanceRepository $repository
     */
    public function __construct(ProductBalanceRepository $repository, SumHelper $sumHelper, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->sumHelper = $sumHelper;
        $this->em = $em;
    }

    public function createProductBalanceFromCart(Cart $cart): ProductBalance
    {
        $productBalance = new ProductBalance();
        $productBalance->setProductSupply(null);
        $productBalance->setOrderId(null);
        $productBalance->setReserved($cart->getQuantity());
        $productBalance->setProduct($cart->getProduct());
        $productBalance->setQuantity(-$cart->getQuantity());
        $productBalance->setCart($cart);
        return $productBalance;
    }

    public function editProductBalanceFromCart(Cart $cart): ProductBalance
    {
        $productBalance = $this->repository->findOneBy(['cart' => $cart]);
        $productBalance->setReserved($cart->getQuantity());
        $productBalance->setQuantity(-$cart->getQuantity());
        return $productBalance;
    }

    /**
     * @throws NonUniqueResultException|NoResultException
     */
    public function productAmountInStock($product): mixed
    {
        $rez = $this->repository->countProductBalance($product);
        //dd($rez);
        return $rez;
    }

    public function getProductBalanceByCart(Cart $cart): ?ProductBalance
    {
        return $this->repository->findOneBy(['cart' => $cart->getId()]);
    }
}