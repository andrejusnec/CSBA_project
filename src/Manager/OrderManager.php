<?php

namespace App\Manager;

use App\Entity\Order;
use App\Entity\ProductOrderList;
use App\Entity\User;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderManager
{
    private OrderRepository $repository;
    private ProductOrderListManager $productOrderListManager;
    private EntityManagerInterface $em;

    public function __construct(OrderRepository $repository, ProductOrderListManager $productOrderListManager, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->productOrderListManager = $productOrderListManager;
        $this->em = $em;
    }

    public function getOrder($orderId): ?Order
    {
        return $this->repository->find($orderId);
    }

    /**
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function newOrder($data, User $user, $carts)
    {
            $this->em->getConnection()->beginTransaction();
            try {
                $order = new Order();
                $order->setUser($user);
                $order->setCountry($data->getCountry());
                $order->setCity($data->getCity());
                $order->setAddress($data->getAddress());
                $order->setPostCode($data->getPostCode());
                $order->uniqOrderNumber();
                $order->setDate(new \DateTime('Europe/Vilnius'));
                $order->setIsActive(true);
                $order->setStatus(true);
                $this->em->persist($order);

                $productOrderLists = $this->productOrderListManager->createProductOrderLists($carts, $order, $this->em);
                foreach ($productOrderLists as $list) {
                    $order->addProductOrderList($list);
                }
                $this->em->persist($order);
                $this->em->flush();
                $this->em->getConnection()->commit();
            } catch (\Exception $e) {
                $this->em->getConnection()->rollBack();
                throw $e;
            }
        }
}