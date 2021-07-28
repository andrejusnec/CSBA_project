<?php


namespace App\Manager;


use App\Entity\Cart;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;

class CartManager
{
    private CartRepository $repository;
    private UserManager $userManager;
    private ProductAndServicesManager $productManager;
    private EntityManagerInterface $entityManager;

    /**
     * ProductAndServicesManager constructor.
     * @param CartRepository $repository
     * @param UserManager $userManager
     * @param ProductAndServicesManager $productManager
     */
    public function __construct(CartRepository $repository, ProductAndServicesManager $productManager, UserManager $userManager, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->userManager = $userManager;
        $this->productManager = $productManager;
        $this->entityManager = $entityManager;
    }


    public function createCart($product, $user) : ?bool
    {
        $flag = false;
        if($this->repository->findOneBy(['user'=> $user, 'product'=> $product]) === null) {
            $cart = new Cart();
            $cart->setUser($this->userManager->repository->find($user));
            $cart->setProduct($this->productManager->findOne($product));
            $cart->setPrice(99.9);
            $cart->setQuantity(1);
            $cart->setTotal(99.9 * 1);
            $this->entityManager->persist($cart);
            $this->entityManager->flush();
            $flag = true;
        }
        return $flag;
    }
    public function getAllUserCartItems($id)
    {
        return $this->repository->findBy(['user'=> $id]);
    }


    public function removeItem($product)
    {
        $cart = $this->repository->findOneBy(['product'=> $product]);
        $this->entityManager->remove($cart);
        $this->entityManager->flush();
    }

}