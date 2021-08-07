<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Manager\PriceManager;
use App\Manager\WishListManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CartController extends AbstractController
{
    private WishListManager $wishListManager;
    private CartManager $cartManager;
    private Security $security;
    private PriceManager $priceManager;

    /**
     * WishListController constructor.
     * @param WishListManager $wishListManager
     * @param CartManager $cartManager
     */
    public function __construct(WishListManager $wishListManager,
                                CartManager     $cartManager,
                                Security        $security,
                                PriceManager    $priceManager)
    {
        $this->wishListManager = $wishListManager;
        $this->cartManager = $cartManager;
        $this->security = $security;
        $this->priceManager = $priceManager;
    }

    /**
     * @Route("cart", name="pages/cart", methods={"GET"})
     */
    public function cart(): Response
    {
        $cart = null;
        $currentUser = $this->security->getUser();
        if ($currentUser !== null) {
            $cart = $this->cartManager->getAllUserCartItems($currentUser->getId());
        }
        return $this->render('pages/cart.html.twig', [
            'cart' => $cart,
            'pm' => $this->priceManager
        ]);
    }

    /**
     * @Route("cart_add/{product<\d+>}/{user<\d+>}/{fromWishList<false|true>}", name="cart_add", methods="POST", defaults={"fromWishList":false})
     */
    public function addToCart($product, $user, $fromWishList): JsonResponse
    {
        if ($fromWishList) {
            $this->wishListManager->removeFromWishList($product);
        }
        try {
            $this->cartManager->createCart($product, $user);
        } catch (NoResultException | NonUniqueResultException $e) {
        }
        $currentlyInTheCart = count($this->cartManager->getAllUserCartItems($user));
        return $this->json(['cart_count' => $currentlyInTheCart]);
    }

    /**
     * @Route("cart_remove/{product<\d+>}", name="cart_remove", methods="POST")
     */
    public function removeFromCart($product): RedirectResponse
    {
        if ($this->cartManager->getCart($product) !== null) {
            $user_id = $this->security->getUser()->getId();
            $this->cartManager->removeItem($product, $user_id);
        }
        return $this->redirectToRoute('pages/cart');
    }

    /**
     * @Route("cart_quantity/{product}/{user}/{direction}", name="cart_quantity", methods="POST")
     */
    public function cartQuantity($product, $user, $direction): JsonResponse
    {
        if ($direction === 'plus') {
            try {
                $this->cartManager->createCart($product, $user);
            } catch (NoResultException | NonUniqueResultException $e) {
            }
        } elseif ($direction === 'minus') {
            $this->cartManager->editCart($user, $product);
        }
        $amount = $this->cartManager->getCartTotal($product, $user);
        $quantity = $this->cartManager->getCartQuantity($product, $user);
        return $this->json(['cart' => $amount, 'currentAmountInCart' => $quantity]);
    }
}
