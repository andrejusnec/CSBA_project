<?php

namespace App\EventListener;

use App\Entity\ProductBalance;
use App\Entity\ProductSupply;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductSupplyStatusListener
{
    /**
     * @param ProductSupply $productSupply
     * @param LifecycleEventArgs $event
     * @ORM\PostUpdate()
     */
    public function postUpdateHandler(ProductSupply $productSupply, LifecycleEventArgs $event): void
    {
        $em = $event->getObjectManager();
        if (false === $productSupply->getIsActive() || false === $productSupply->getStatus()) {
            $repo = $em->getRepository(ProductBalance::class);
            $allProductBalances = $repo->findBy(['product_supply' => $productSupply]);
            foreach ($allProductBalances as $value) {
                $em->remove($value);
            }
            $em->flush();
        }
    }
}