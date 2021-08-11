<?php

namespace App\Controller;


use App\Manager\PriceManager;
use App\Manager\ProductAndServicesManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private ProductAndServicesManager $productManager;
    private PriceManager $priceManager;


    /**
     * MainController constructor.
     */
    public function __construct(ProductAndServicesManager $productManager,
                                PriceManager              $priceManager)
    {
        $this->productManager = $productManager;
        $this->priceManager = $priceManager;
    }

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function main(): Response
    {
        $products = $this->productManager->getTenRandomProducts();
        $allCategories = $this->productManager->hierarchy();
        $price = ($this->priceManager->getPriceByPeriod(403));
        return $this->render('pages/main.html.twig',
            ['allCategories' => $allCategories, 'period' => $price, 'products' => $products, 'pm' => $this->priceManager]);
    }

    /**
     * @Route("contact", name="pages/contact", methods={"GET"})
     */
    public function contact(): Response
    {
        return $this->render('pages/contact.html.twig');
    }

}