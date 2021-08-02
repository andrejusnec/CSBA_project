<?php

namespace App\Manager;

use App\Entity\ProductOrderList;
use App\Repository\ProductOrderListRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductOrderListManager
{
private ProductOrderListRepository $repository;


    public function __construct(ProductOrderListRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createProductOrderLists($cartWithProducts, $order, EntityManagerInterface $em) {
        $productOrderListArray = [];
        foreach ($cartWithProducts as $cart) {
            $productOrderList = new ProductOrderList();
            $productOrderList->setProduct($cart->getProduct());
            //$productOrderList->setOrderId($order);
            $productOrderList->setPrice($cart->getPrice());
            $productOrderList->setQuantity($cart->getQuantity());
            $productOrderList->setTotal($cart->getTotal());
            $em->persist($productOrderList);
            $productOrderListArray[] = $productOrderList;
        }
        return $productOrderListArray;
    }

}