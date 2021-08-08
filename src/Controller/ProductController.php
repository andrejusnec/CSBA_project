<?php

namespace App\Controller;

use App\Manager\PriceManager;
use App\Manager\ProductAndServicesManager;
use App\Manager\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductAndServicesManager $productManager;
    private PriceManager $priceManager;
    private TagManager $tagManager;

    /**
     * MainController constructor.
     */
    public function __construct(ProductAndServicesManager $productManager,
                                PriceManager              $priceManager,
                                TagManager                $tagManager)
    {
        $this->productManager = $productManager;
        $this->priceManager = $priceManager;
        $this->tagManager = $tagManager;
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
     * @Route("product_list", name="pages/product_list", methods={"GET"})
     */
    public function product_list(): Response
    {
        $allProducts = $this->productManager->findAllProducts();
        $allCategories = $this->productManager->hierarchy();
        return $this->render('pages/product_list.html.twig', ['allCategories' => $allCategories,
            'allProducts' => $allProducts,
            'pm' => $this->priceManager,
            'productManager' => $this->productManager,
            'tags' => $this->tagManager->getAllTags()]);
    }

    /**
     * @Route("pages/product_list_show/{slug}", name="pages/product_list_show", methods={"GET"})
     */
    public function product_list_show($slug): Response
    {
        $selectedProducts = [];
        $this->productManager->getAllCategoryProducts($slug, $selectedProducts);
        $tagsOfSelectedProducts = $this->productManager->getTagsFromListOfProducts($selectedProducts);
        //dd($tagsOfSelectedProducts);
        $allCategories = $this->productManager->hierarchy();
        return $this->render('pages/product_list.html.twig',
            ['allCategories' => $allCategories,
                'selectedProducts' => $selectedProducts,
                'product_id' => $slug,
                'productManager' => $this->productManager,
                'pm' => $this->priceManager,
                'tagsOfSelectedProducts' => $tagsOfSelectedProducts]);
    }

    /**
     * @Route("pages/product_show_by_tag/{tag}", name="pages/product_show_by_tag", methods={"GET"})
     */
    public function product_show_by_tag($tag): Response
    {
        $tag = $this->tagManager->getTag($tag);
        $tagProducts = $tag->getProductsAndServices();
        $allCategories = $this->productManager->hierarchy();
        //dd($tagProducts);
        return $this->render('pages/product_list.html.twig', ['products' => $tagProducts,
            'allCategories' => $allCategories,
            'productManager' => $this->productManager,
            'pm' => $this->priceManager,
            'tags' => $this->tagManager->getAllTags()]);
    }

    /**
     * @Route("test/{slug}", name="test", methods={"POST"})
     */

    public function test($slug)
    {
        $product = $this->productManager->findOne($slug);
        if($product->getIsCatalog()){
            $allProductsOfCategory = $this->productManager->findCategoryProducts($slug);
        }
        return $this->json(['testai' => $allProductsOfCategory ?? null]);
    }
}
