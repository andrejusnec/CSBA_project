<?php

namespace App\EventListener;

use App\Entity\Order;
use App\Entity\ProductBalance;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class OrderEditListener
{
    /**
     * @param Order $order
     * @param LifecycleEventArgs $event
     * @ORM\PostUpdate()
     */
    public function postUpdateHandler(Order $order, LifecycleEventArgs $event): void
    {
        $em = $event->getObjectManager();
        //dd($productSupply->getIsActive(), $productSupply->getStatus());
        if (false === $order->getIsActive() || false === $order->getStatus()) {
            $repo = $em->getRepository(ProductBalance::class);
            $allProductBalances = $repo->findBy(['order_id' => $order]);
            foreach ($allProductBalances as $value) {
                $em->remove($value);
            }
        } else if ($order->getIsActive() && $order->getStatus()) {
            $repo = $em->getRepository(ProductBalance::class);
            $allProductBalances = $repo->findBy(['order_id' => $order]);
            if (!empty($allProductBalances)) {
                foreach ($allProductBalances as $value) {
                    $em->remove($value);
                }
            }
            $productListArray = $order->getProductOrderLists();
            if (!empty($productListArray) && null !== $productListArray) {
                foreach ($productListArray as $item) {
                    $productBalance = new ProductBalance();
                    $productBalance->setProductSupply(null);
                    $productBalance->setOrderId($order);
                    $productBalance->setReserved(0);
                    $productBalance->setProduct($item->getProduct());
                    $productBalance->setQuantity(-$item->getQuantity());
                    $em->persist($productBalance);
                }
            }
        }
        $em->flush();
    }
}