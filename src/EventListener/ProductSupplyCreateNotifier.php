<?php

namespace App\EventListener;

use App\Entity\ProductBalance;
use App\Entity\ProductSupply;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductSupplyCreateNotifier
{
    /**
     * @param ProductSupply $productSupply
     * @param LifecycleEventArgs $event
     * Listens to ProductSupply entity and creates an ProductBalance object
     * depending on ProductSupply status
     * @PostPersist
     */

    public function postPersistHandler(ProductSupply $productSupply, LifecycleEventArgs $event): void
    {
        $em = $event->getObjectManager();
        //dd($test);
        if ($productSupply->getIsActive() && $productSupply->getStatus()) {
            $productListArray = $productSupply->getProductSupplyLists();
            if ([] !== $productListArray && null !== $productListArray) {
                foreach ($productListArray as $item) {
                    $productBalance = new ProductBalance();
                    $productBalance->setProductSupply($productSupply);
                    $productBalance->setOrderId(null);
                    $productBalance->setReserved(0);
                    $productBalance->setProduct($item->getProduct());
                    $productBalance->setQuantity($item->getQuantity());
                    $em->persist($productBalance);
                }
                $em->flush();
            }
//        }elseif (false === $productSupply->getIsActive() || false === $productSupply->getStatus()) {
//                $repo = $em->getRepository(ProductBalance::class);
//                $allProductBalances = $repo->findBy(['product_supply' => $productSupply]);
//                foreach ($allProductBalances as $value) {
//                    $em->persist($value);
//                }
//                $em->flush();
        }
    }

}