<?php

namespace App\Controller;

use App\Manager\PriceManager;
use App\Manager\ProductAndServicesManager;
use App\Manager\TagManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductAndServicesManager $productManager;
    private PriceManager $priceManager;
    private TagManager $tagManager;
    private PaginatorInterface $paginator;

    /**
     * MainController constructor.
     */
    public function __construct(ProductAndServicesManager $productManager,
                                PriceManager              $priceManager,
                                TagManager                $tagManager,
                                PaginatorInterface        $paginator)
    {
        $this->productManager = $productManager;
        $this->priceManager = $priceManager;
        $this->tagManager = $tagManager;
        $this->paginator = $paginator;
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
    public function product_list(Request $request): Response
    {
        $q = $request->query->get('q');
        $query = $this->productManager->findAllWithSearch($q);
        $allCategories = $this->productManager->hierarchy();
        //$query = $this->productManager->findAllProductsWithPagination();
        $pagination = $this->paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        return $this->render('pages/product_list.html.twig', ['allCategories' => $allCategories,
//            'allProducts' => $allProducts,
            'pm' => $this->priceManager,
            'productManager' => $this->productManager,
            'tags' => $this->tagManager->getAllTags(),
            'pagination' => $pagination]);
    }

    /**
     * @Route("pages/product_list_show/{slug}", name="pages/product_list_show", methods={"GET"})
     */
    public function product_list_show($slug, Request $request): Response
    {
//        $catalogs = [];
//        $this->productManager->getAllCategories($slug, $catalogs);
//        $test = $this->productManager->findAllWithSearch(null, $catalogs);
//        //dd($test);
        $selectedProducts = [];
        $this->productManager->getAllCategoryProducts($slug, $selectedProducts);
        $tagsOfSelectedProducts = $this->productManager->getTagsFromListOfProducts($selectedProducts);
        $query = $selectedProducts;
        $q = $request->query->get('q');
        //$query = $this->productManager->findAllWithSearch($q);
//        $pagination = $this->paginator->paginate(
//            $test, /* query NOT result */
//            $request->query->getInt('page', 1),
//            6
//        );
        $allCategories = $this->productManager->hierarchy();

        return $this->render('pages/product_list.html.twig',
            ['allCategories' => $allCategories,
                'selectedProducts' => $selectedProducts,
                //'pagination' => $pagination,
                'product_id' => $slug,
                'productManager' => $this->productManager,
                'pm' => $this->priceManager,
                'tagsOfSelectedProducts' => $tagsOfSelectedProducts]);
    }

    /**
     * @Route("pages/product_show_by_tag/{tag}", name="pages/product_show_by_tag", methods={"GET"})
     */
    public function product_show_by_tag(Request $request, $tag): Response
    {
        $tag = $this->tagManager->getTag($tag);
        $tagProducts = $tag->getProductsAndServices();
        $allCategories = $this->productManager->hierarchy();
        $test = $this->productManager->getTagProductsForPagination($tag);
        //dd($test);
        $pagination = $this->paginator->paginate(
            $test, /* query NOT result */
            $request->query->getInt('page', 1),
            6
        );
        //dd($pagination);
        return $this->render('pages/product_list.html.twig', [
            'products' => $tagProducts,
            'allCategories' => $allCategories,
            'productManager' => $this->productManager,
            'pm' => $this->priceManager,
            'tags' => $this->tagManager->getAllTags(), 'pagination' => $pagination]);
    }
}
