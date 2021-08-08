<?php

namespace App\EventListener;

use App\Entity\ProductBalance;
use App\Entity\ProductSupplyList;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductSupplyListEditListener
{
    /**
     * @param ProductSupplyList $productSupplyList
     * @param LifecycleEventArgs $event
     * @ORM\PostUpdate()
     */
    public function postUpdateHandler(ProductSupplyList $productSupplyList, LifecycleEventArgs $event): void
    {
        $listener = new ProductSupplyEditListener();
        $listener->postUpdateHandler($productSupplyList->getProductSupply(), $event);

    }
}