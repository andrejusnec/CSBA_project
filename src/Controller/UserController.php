<?php

namespace App\Controller;

use App\Manager\OrderManager;
use App\Service\SumHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    private Security $security;

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("my_account", name="pages/my_account", methods={"GET"})
     */
    public function my_account(OrderManager $om): Response
    {
        $orders = null;
        $user = $this->security->getUser();
        if ($user !== null) {
            $orders = $om->getUserOrders($user);
        }
        return $this->render('pages/my_account.html.twig', ['orders' => $orders]);
    }
}
