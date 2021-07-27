<?php

namespace App\Controller;

use App\Manager\WishListManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishListController extends AbstractController
{
    private WishListManager $manager;

    /**
     * WishListController constructor.
     * @param WishListManager $manager
     */
    public function __construct(WishListManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("wishlists/{product}/{user}", name="kazkas")
     */
    public function addToWishList($product, $user)
    {
        $this->manager->createWishList($product, $user);
        return new Response('paviko');
    }

    /**
     * @Route("wishlist_remove/{product}", name="wishlist_remove")
     */
    public function removeWish($product)
    {
        $this->manager->removeFromWishList($product);
        return $this->redirectToRoute('pages/wishlist');
    }
}
