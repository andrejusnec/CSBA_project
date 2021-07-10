<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends  AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function m(): string
    {
        return 'Hello';
    }
    /**
     * @Route("/main", name="main", methods={"GET"})
     */
    public function main(): Response
    {
        return $this->render('pages/main.html.twig');
    }
    /**
     * @Route("product_details", name="pages/product_details", methods={"GET"})
     */
    public function product_details(): Response
    {
        return $this->render('pages/product_details.html.twig');
    }
    /**
     * @Route("cart", name="pages/cart", methods={"GET"})
     */
    public function cart(): Response
    {
        return $this->render('pages/cart.html.twig');
    }
    /**
     * @Route("checkout", name="pages/checkout", methods={"GET"})
     */
    public function checkout(): Response
    {
        return $this->render('pages/checkout.html.twig');
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
    public function my_account(): Response
    {
        return $this->render('pages/my_account.html.twig');
    }
    /**
     * @Route("product_list", name="pages/product_list", methods={"GET"})
     */
    public function product_list(): Response
    {
        return $this->render('pages/product_list.html.twig');
    }
    /**
     * @Route("wishlist", name="pages/wishlist", methods={"GET"})
     */
    public function wishlist(): Response
    {
        return $this->render('pages/wishlist.html.twig');
    }

}