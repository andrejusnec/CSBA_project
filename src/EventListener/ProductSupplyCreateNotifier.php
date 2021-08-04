<?php

namespace App\EventListener;

use App\Entity\ProductBalance;
use App\Entity\ProductSupply;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class ProductSupplyCreateNotifier
{
//    private EntityManagerInterface $em;
//
//    /**
//     * @param EntityManagerInterface $em
//     */
//    public function __construct(EntityManagerInterface $em)
//    {
//        $this->em = $em;
//    }


    /**
     * @param ProductSupply $productSupply
     * @param LifecycleEventArgs $event
     * Listens to ProductSupply entity and creates an ProductBalance object
     * depending on ProductSupply status
     * @PostPersist
     */
    public function postPersistHandler(ProductSupply $productSupply, LifecycleEventArgs $event): void
    {
        $test = $event->getObjectManager();
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
                    $test->persist($productBalance);
                }
                $test->flush();
            }
        }
    }
}