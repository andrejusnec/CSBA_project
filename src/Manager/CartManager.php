<?php


namespace App\Manager;


use App\Entity\Cart;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class CartManager
{
    private CartRepository $repository;
    private UserManager $userManager;
    private ProductAndServicesManager $productManager;
    private EntityManagerInterface $entityManager;
    private PriceManager $priceManager;

    /**
     * ProductAndServicesManager constructor.
     * @param PriceManager $priceManager
     * @param CartRepository $repository
     * @param ProductAndServicesManager $productManager
     * @param UserManager $userManager
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(PriceManager              $priceManager,
                                CartRepository            $repository,
                                ProductAndServicesManager $productManager,
                                UserManager               $userManager,
                                EntityManagerInterface    $entityManager,)
    {
        $this->repository = $repository;
        $this->userManager = $userManager;
        $this->productManager = $productManager;
        $this->entityManager = $entityManager;
        $this->priceManager = $priceManager;
    }

    public function getCart($product_id): ?Cart
    {
        return $this->repository->findOneBy(['product' => $product_id]);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function createCart($product, $user)
    {
        $cart = $this->repository->findOneBy(['user' => $user, 'product' => $product]);
        if ($cart === null) {
            $cart = new Cart();
            $cart->setUser($this->userManager->repository->find($user));
            $cart->setProduct($this->productManager->findOne($product));
            $cart->setPrice($cart->getProduct()->getCurrentPrice($this->priceManager));
            $cart->setQuantity(1);
            $cart->setTotal($cart->getPrice() * 1);
        } else {
            $productEntity = $this->productManager->findOne($product);
            $amountInStock = $this->productManager->getProductAmountInStock($productEntity);
            if ($amountInStock > $cart->getQuantity()) {
                $amount = $cart->getQuantity() + 1;
                $cart->setQuantity($amount);
                $cart->setTotal($cart->getPrice() * $amount);
            }
        }
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
    }

    public function getAllUserCartItems($id): ?array
    {
        return $this->repository->findBy(['user' => $id]);
    }

    public function getCartTotal($product, $user): float
    {
        $cart = $this->repository->findOneBy(['product' => $product, 'user' => $user]);
        return $cart->getTotal();
    }

    public function getCartQuantity($product, $user): float
    {
        $cart = $this->repository->findOneBy(['product' => $product, 'user' => $user]);
        return $cart->getQuantity();
    }

    public function removeItem($product)
    {
        $cart = $this->repository->findOneBy(['product' => $product]);
        $this->entityManager->remove($cart);
        $this->entityManager->flush();
    }

    public function editCart($user, $product)
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