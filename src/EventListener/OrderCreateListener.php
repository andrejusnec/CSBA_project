<?php

namespace App\EventListener;

use App\Entity\Order;
use App\Entity\ProductBalance;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class OrderCreateListener
{
    /**
     * @param Order $order
     * @param LifecycleEventArgs $event
     * Listens to ProductSupply entity and creates an ProductBalance object
     * depending on ProductSupply status
     * @PostPersist
     */

    public function postPersistHandler(Order $order, LifecycleEventArgs $event): void
    {
        $em = $event->getObjectManager();
        if ($order->getIsActive() && $order->getStatus()) {
            $ProductOrderLists = $order->getProductOrderLists();
            if (!empty($ProductOrderLists)) {
                foreach ($ProductOrderLists as $item) {
                    $productBalance = new ProductBalance();
                    $productBalance->setProductSupply(null);
                    $productBalance->setOrderId($order);
                    $productBalance->setReserved(0);
                    $productBalance->setProduct($item->getProduct());
                    $productBalance->setQuantity(-$item->getQuantity());
                    $em->persist($productBalance);
                }
                $em->flush();
            }
        }
    }
}