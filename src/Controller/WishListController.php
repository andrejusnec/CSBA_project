<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Manager\WishListManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishListController extends AbstractController
{
    private WishListManager $wishListManager;
    private CartManager $cartManager;

    /**
     * WishListController constructor.
     * @param WishListManager $wishListManager
     * @param CartManager $cartManager
     */
    public function __construct(WishListManager $wishListManager, CartManager $cartManager)
    {
        $this->wishListManager = $wishListManager;
        $this->cartManager = $cartManager;
    }

    /**
     * @Route("wishlists/{product}/{user}", name="kazkas")
     */
    public function addToWishList($product, $user)
    {
        $this->wishListManager->createWishList($product, $user);
        return new Response('paviko');
    }

    /**
     * @Route("wishlist_remove/{product}", name="wishlist_remove")
     */
    public function removeWish($product): RedirectResponse
    {
        $this->wishListManager->removeFromWishList($product);
        return $this->redirectToRoute('pages/wishlist');
    }

    /**
     * @Route("cart_add/{product}/{user}/{fromWishList}", name="cart", defaults={"fromWishList":false})
     */
    public function addToCart($product, $user, $fromWishList)
    {
        if($fromWishList) {
            $this->wishListManager->removeFromWishList($product);
        }
        $this->cartManager->createCart($product, $user);

        return new Response('success');
    }

    /**
     * @Route("cart_remove/{product}", name="cart_remove")
     */
    public function removeFromCart($product): RedirectResponse
    {
        $this->cartManager->removeItem($product);
        return $this->redirectToRoute('pages/cart');
    }

}
