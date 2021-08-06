<?php

namespace App\Controller;


use App\Entity\Order;
use App\Form\OrderType;
use App\Manager\CartManager;
use App\Manager\CountryManager;
use App\Manager\OrderManager;
use App\Manager\PriceManager;
use App\Manager\ProductAndServicesManager;
use App\Manager\ProductOrderListManager;
use App\Manager\WishListManager;
use App\Service\SumHelper;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\NonUniqueResultException;
use PHPUnit\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TestController extends AbstractController
{
    private ProductAndServicesManager $productManager;
    private Security $security;
    private WishListManager $wishListManager;
    private CartManager $cartManager;
    private PriceManager $priceManager;

    /**
     * TestController constructor.
     */
    public function __construct(ProductAndServicesManager $productManager,
                                Security                  $security,
                                WishListManager           $wishListManager,
                                CartManager               $cartManager,
                                PriceManager              $priceManager)
    {
        $this->productManager = $productManager;
        $this->security = $security;
        $this->wishListManager = $wishListManager;
        $this->cartManager = $cartManager;
        $this->priceManager = $priceManager;
    }

    /**
     * @Route("/home", name="home", methods={"GET"})
     */
    public function main(): Response
    {
        $allCategories = $this->productManager->hierarchy();
        $price = ($this->priceManager->getPriceByPeriod(403));
        return $this->render('pages/main.html.twig',
            ['allCategories' => $allCategories, 'user' => $this->getUser(), 'period' => $price]);
    }

    /**
     * @Route("product_details", name="pages/product_details", methods={"GET"})
     */
    public function product_details(): Response
    {
        return $this->render('pages/product_details.html.twig', ['pm' => $this->priceManager]);
    }

    /**
     * @Route("product_details/{slug}", name="pages/product_details_show", methods={"GET"})
     */
    public function product_details_show($slug): Response
    {
        $product = $this->productManager->findOne($slug);
        return $this->render('pages/product_details.html.twig', ['product' => $product, 'pm' => $this->priceManager]);
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
     * @Route("checkout", name="pages/checkout")
     * @throws ConnectionException
     */
    public function checkout(CountryManager $country, Request $request, OrderManager $om): Response
    {
        $allCountries = $country->allCountries();
        $user = $this->security->getUser();
        $carts = null;
        if ($user !== null) {
            $carts = $this->cartManager->getAllUserCartItems($user->getId());
        }
        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $om->newOrder($data, $user, $carts);
            $this->addFlash('success', 'You have successfully placed your order.');
            return $this->redirectToRoute('pages/my_account');
        }
        return $this->render('pages/checkout.html.twig', ['countries' => $allCountries, 'cart' => $carts, 'form' => $form->createView()]);
    }

    /**
     * @Route("contact", name="pages/contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

    /**
     * @Route("login", name="pages/login", methods={"GET"})
     */
    public function login(): Response
    {
        return $this->render('pages/login.html.twig');

    }

    /**
     * @Route("my_account", name="pages/my_account", methods={"GET"})
     */
    public function my_account(OrderManager $om, SumHelper $sumHelper): Response
    {
        $orders = null;
        $user = $this->security->getUser();
        if ($user !== null) {
            $orders = $om->getUserOrders($user);
        }
        return $this->render('pages/my_account.html.twig', ['orders' => $orders]);
    }

    /**
     * @Route("product_list", name="pages/product_list", methods={"GET"})
     */
    public function product_list(): Response
    {
        $allProducts = $this->productManager->findAllProducts();
        $allCategories = $this->productManager->hierarchy();
        return $this->render('pages/product_list.html.twig', ['allCategories' => $allCategories,
            'allProducts' => $allProducts,
            'pm' => $this->priceManager,
            'productManager' => $this->productManager]);
    }

    /**
     * @Route("pages/product_list_show/{slug}", name="pages/product_list_show", methods={"GET"})
     */
    public function product_list_show($slug): Response
    {
        $selectedProducts = [];
        $this->productManager->getAllCategoryProducts($slug, $selectedProducts);

        $allCategories = $this->productManager->hierarchy();
        return $this->render('pages/product_list.html.twig',
            ['allCategories' => $allCategories,
                'selectedProducts' => $selectedProducts,
                'product_id' => $slug,
                'productManager' => $this->productManager,
                'pm' => $this->priceManager]);
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
     * @Route("show_order/{id}", name="pages/show_order")
     */
    public function showOrderItem($id, ProductOrderListManager $pm, OrderManager $om): Response
    {
        $productOrderLists = $pm->getAll($id);
        $order = $om->getOrder($id);
        return $this->render('pages/show_order.html.twig', ['productOrderLists' => $productOrderLists ?? null, 'order' => $order ?? null]);
    }

}