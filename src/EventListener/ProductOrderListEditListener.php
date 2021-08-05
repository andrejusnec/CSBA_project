<?php

namespace App\EventListener;

use App\Entity\Order;
use App\Entity\ProductOrderList;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductOrderListEditListener
{
    /**
     * @param ProductOrderList $productOrderList
     * @param LifecycleEventArgs $event
     * @ORM\PostUpdate()
     */
    public function postUpdateHandler(ProductOrderList $productOrderList, LifecycleEventArgs $event): void
    {
        $listener = new OrderEditListener();
        $listener->postUpdateHandler($productOrderList->getOrderId(), $event);

    }
}