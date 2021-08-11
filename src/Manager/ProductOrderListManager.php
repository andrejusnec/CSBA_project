<?php

namespace App\Manager;

use App\Entity\Cart;
use App\Entity\ProductBalance;
use App\Entity\ProductOrderList;
use App\Repository\ProductOrderListRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductOrderListManager
{
    private ProductOrderListRepository $repository;
    private PriceManager $pm;


    public function __construct(ProductOrderListRepository $repository, PriceManager $pm)
    {
        $this->repository = $repository;
        $this->pm = $pm;
    }

    public function getAll($order_id): array
    {
        return $this->repository->findBy(['order_id' => $order_id]);
    }

    public function createProductOrderLists($cartWithProducts, EntityManagerInterface $em): array
    {
        $productOrderListArray = [];
        foreach ($cartWithProducts as $cart) {
            $productOrderList = new ProductOrderList();
            $productOrderList->setProduct($cart->getProduct());
            $productOrderList->setPrice($this->pm->getPriceByPeriod($cart->getProduct()->getId()));
            $productOrderList->setQuantity($cart->getQuantity());
            $productOrderList->setTotal($cart->getTotal());
            $em->persist($productOrderList);
            $productOrderListArray[] = $productOrderList;
            if (!empty($cart)) {
                $productBalance = $em->getRepository(ProductBalance::class)->findOneBy(['cart' => $cart]);
                $em->remove($productBalance);
                $em->remove($cart);
            }
        }
        return $productOrderListArray;
    }

}