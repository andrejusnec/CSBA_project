<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Manager\ProductAndServicesManager;
use App\Manager\ProductBalanceManager;
use App\Manager\WishListManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishListController extends AbstractController
{
    private WishListManager $wishListManager;
    private CartManager $cartManager;
    private ProductBalanceManager $productBalanceManager;
    private ProductAndServicesManager $productManager;

    /**
     * WishListController constructor.
     * @param WishListManager $wishListManager
     * @param CartManager $cartManager
     */
    public function __construct(WishListManager $wishListManager,
                                CartManager $cartManager,
                                ProductBalanceManager $productBalanceManager,
                                ProductAndServicesManager $productManager)
    {
        $this->wishListManager = $wishListManager;
        $this->cartManager = $cartManager;
        $this->productBalanceManager = $productBalanceManager;
        $this->productManager = $productManager;
    }

    /**
     * @Route("wishlists/{product<\d+>}/{user<\d+>}", name="add_to_wishlist", methods="POST")
     */
    public function addToWishList($product, $user): Response
    {
        $this->wishListManager->createWishList($product, $user);
        return new Response('paviko');
    }

    /**
     * @Route("wishlist_remove/{product<\d+>}", name="wishlist_remove", methods="POST")
     */
    public function removeWish($product): RedirectResponse
    {
        $this->wishListManager->removeFromWishList($product);
        return $this->redirectToRoute('pages/wishlist');
    }

    /**
     * @Route("cart_add/{product<\d+>}/{user<\d+>}/{fromWishList<false|true>}", name="cart_add", methods="POST", defaults={"fromWishList":false})
     */
    public function addToCart($product, $user, $fromWishList): JsonResponse
    {
        if($fromWishList) {
            $this->wishListManager->removeFromWishList($product);
        }
        $this->cartManager->createCart($product, $user);
        $currentlyInTheCart = count($this->cartManager->getAllUserCartItems($user));
        return $this->json(['cart_count' => $currentlyInTheCart]);
    }

    /**
     * @Route("cart_remove/{product<\d+>}", name="cart_remove", methods="GET")
     */
    public function removeFromCart($product): RedirectResponse
    {
            if($this->cartManager->getCart($product) !== null) {
                $this->cartManager->removeItem($product);
            }
        return $this->redirectToRoute('pages/cart');
    }
    /**
     * @Route("cart_quantity/{product}/{user}/{direction}", name="cart_quantity", methods="POST")
     */
    public function cartQuantity($product, $user, $direction): JsonResponse
    {
        if($direction === 'plus') {
            $this->cartManager->createCart($product, $user);
        } elseif ($direction === 'minus') {
            $this->cartManager->editCart($user, $product);
        }
        $amount = $this->cartManager->getCartTotal($product, $user);
        $quantity = $this->cartManager->getCartQuantity($product, $user);
        return $this->json(['cart' => $amount, 'currentAmountInCart' => $quantity]);
    }
}
