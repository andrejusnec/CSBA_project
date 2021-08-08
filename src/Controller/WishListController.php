<?php

namespace App\Controller;

use App\Manager\CartManager;
use App\Manager\PriceManager;
use App\Manager\ProductAndServicesManager;
use App\Manager\ProductBalanceManager;
use App\Manager\WishListManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class WishListController extends AbstractController
{
    private WishListManager $wishListManager;
    private ProductAndServicesManager $productManager;
    private Security $security;
    private PriceManager $priceManager;

    /**
     * WishListController constructor.
     * @param WishListManager $wishListManager
     * @param ProductAndServicesManager $productManager
     * @param Security $security
     * @param PriceManager $priceManager
     */
    public function __construct(WishListManager           $wishListManager,
                                ProductAndServicesManager $productManager,
                                Security                  $security,
                                PriceManager              $priceManager)
    {
        $this->wishListManager = $wishListManager;
        $this->productManager = $productManager;
        $this->security = $security;
        $this->priceManager = $priceManager;
    }

    /**
     * @Route("wishlist", name="pages/wishlist", methods={"GET"})
     */
    public function wishlist(): Response
    {
        $wishLists = null;
        $currentUser = $this->security->getUser();
        if ($currentUser !== null) {
            $wishLists = $this->wishListManager->getAllUserWishLists($currentUser->getId());
        }

        return $this->render('pages/wishlist.html.twig', [
            'wishList' => $wishLists,
            'pm' => $this->priceManager,
            'productManager' => $this->productManager
        ]);
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
}
