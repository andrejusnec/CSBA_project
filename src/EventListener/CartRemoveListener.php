<?php

namespace App\EventListener;

use App\Entity\Cart;
use App\Entity\ProductBalance;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class CartRemoveListener
{
    /**
     * @param Cart $cart
     * @param LifecycleEventArgs $event
     * @ORM\PreRemove()
     */
    public function preRemoveHandler(Cart $cart, LifecycleEventArgs $event)
    {
        $em = $event->getObjectManager();
        $productBalance = $em->getRepository(ProductBalance::class)->findOneBy(['cart' => $cart]);
//        //dd($productBalance);
//        if (null !== $productBalance) {
//            $em->remove($productBalance);
//            //$em->flush();
//        }
    }
}