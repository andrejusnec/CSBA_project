<?php


namespace App\Manager;


use App\Entity\WishList;
use App\Repository\WishListRepository;
use Doctrine\ORM\EntityManagerInterface;

class WishListManager
{

    private WishListRepository $repository;
    private UserManager $userManager;
    private ProductAndServicesManager $productManager;
    private EntityManagerInterface $entityManager;

    /**
     * ProductAndServicesManager constructor.
     * @param WishListRepository $repository
     * @param UserManager $userManager
     * @param ProductAndServicesManager $productManager
     */
    public function __construct(WishListRepository $repository, ProductAndServicesManager $productManager, UserManager $userManager, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->userManager = $userManager;
        $this->productManager = $productManager;
        $this->entityManager = $entityManager;
    }
    public function createWishList($product_id, $user_id) {
        if($this->repository->findOneBy(['user'=> $user_id, 'product'=> $product_id]) === null) {
            $wishList = new WishList();
            $wishList->setUser($this->userManager->repository->find($user_id));
            $wishList->setProduct($this->productManager->findOne($product_id));
            $this->entityManager->persist($wishList);
            $this->entityManager->flush();
        }
    }

    public function getAllUserWishLists($id) {
        return $this->repository->findBy(['user'=> $id]);
    }

    public function removeFromWishList($product_id)
    {
        $wish = $this->repository->findOneBy(['product'=> $product_id]);
        $this->entityManager->remove($wish);
        $this->entityManager->flush();

    }

}