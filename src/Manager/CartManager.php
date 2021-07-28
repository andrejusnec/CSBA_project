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


    public function createCart($product, $user)
    {
        $cart = $this->repository->findOneBy(['user' => $user, 'product' => $product]);
        if ($cart === null) {
            $cart = new Cart();
            $cart->setUser($this->userManager->repository->find($user));
            $cart->setProduct($this->productManager->findOne($product));
            $cart->setPrice(99.9);
            $cart->setQuantity(1);
            $cart->setTotal(99.9 * 1);
        } else {
            $amount = $cart->getQuantity() + 1;
            $cart->setQuantity($amount);
            $cart->setTotal($cart->getPrice() * $amount);
        }
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
    }

    public function getAllUserCartItems($id)
    {
        return $this->repository->findBy(['user' => $id]);
    }

    public function getCartTotal($product, $user)
    {
        $cart = $this->repository->findOneBy(['product' => $product, 'user' => $user]);
        return $cart->getTotal();
    }


    public function removeItem($product)
    {
        $cart = $this->repository->findOneBy(['product' => $product]);
        $this->entityManager->remove($cart);
        $this->entityManager->flush();
    }

    public function editCart( $user, $product)
    {
        $cart = $this->repository->findOneBy(['user' => $user, 'product' => $product]);
        $amount = $cart->getQuantity();
        if ($amount > 1) {
            $cart->setTotal($cart->getTotal() - $cart->getPrice());
            $cart->setQuantity($cart->getQuantity() - 1);
            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        }
    }

}