<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Manager\CartManager;
use App\Manager\CountryManager;
use App\Manager\OrderManager;
use App\Manager\ProductOrderListManager;
use Doctrine\DBAL\ConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class OrderController extends AbstractController
{
    private Security $security;
    private CartManager $cartManager;

    /**
     * MainController constructor.
     */
    public function __construct(Security    $security,
                                CartManager $cartManager)
    {
        $this->security = $security;
        $this->cartManager = $cartManager;
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
     * @Route("show_order/{id}", name="pages/show_order")
     */
    public function showOrderItem($id, ProductOrderListManager $pm, OrderManager $om): Response
    {
        $currentUser = $this->security->getUser();
        if($om->getOrder($id) === $currentUser) {
            $productOrderLists = $pm->getAll($id);
            $order = $om->getOrder($id);
        }
        return $this->render('pages/show_order.html.twig', ['productOrderLists' => $productOrderLists ?? null, 'order' => $order ?? null]);
    }
}
