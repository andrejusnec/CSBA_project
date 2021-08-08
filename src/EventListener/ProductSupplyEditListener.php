<?php

namespace App\EventListener;

use App\Entity\ProductBalance;
use App\Entity\ProductSupply;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductSupplyEditListener
{
    /**
     * @param ProductSupply $productSupply
     * @param LifecycleEventArgs $event
     * @ORM\PostUpdate()
     */
    public function postUpdateHandler(ProductSupply $productSupply, LifecycleEventArgs $event): void
    {
        $em = $event->getObjectManager();
        //dd($productSupply->getIsActive(), $productSupply->getStatus());
        if (false === $productSupply->getIsActive() || false === $productSupply->getStatus()) {
            $repo = $em->getRepository(ProductBalance::class);
            $allProductBalances = $repo->findBy(['product_supply' => $productSupply]);
            foreach ($allProductBalances as $value) {
                $em->remove($value);
            }
        } else if ($productSupply->getIsActive() && $productSupply->getStatus()) {
            $repo = $em->getRepository(ProductBalance::class);
            $allProductBalances = $repo->findBy(['product_supply' => $productSupply]);
            //dd($allProductBalances);
            if (!empty($allProductBalances)) {
                foreach ($allProductBalances as $value) {
                    $em->remove($value);
                }
                //$em->flush();
            }
            $productListArray = $productSupply->getProductSupplyLists();
            if (!empty($productListArray) && null !== $productListArray) {
                foreach ($productListArray as $item) {
                    $productBalance = new ProductBalance();
                    $productBalance->setProductSupply($productSupply);
                    $productBalance->setOrderId(null);
                    $productBalance->setReserved(0);
                    $productBalance->setProduct($item->getProduct());
                    $productBalance->setQuantity($item->getQuantity());
                    $em->persist($productBalance);
                }
            }
        }
        $em->flush();
    }
}