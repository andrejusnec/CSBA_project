<?php

namespace App\Controller\Admin;

use App\Controller\EACrudControllers\UserCrudController;
use App\Entity\Cart;
use App\Entity\Country;
use App\Entity\Image;
use App\Entity\Measure;
use App\Entity\Order;
use App\Entity\Price;
use App\Entity\ProductBalance;
use App\Entity\ProductOrderList;
use App\Entity\ProductsAndServices;
use App\Entity\ProductSupply;
use App\Entity\ProductSupplyList;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\WishList;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::subMenu('List', 'fa fa-list')->setSubItems([
                MenuItem::linkToCrud('Users', 'fas fa-user', User::class),
                MenuItem::linkToCrud('Products And Services', 'fas fa-shopping-bag', ProductsAndServices::class),
                MenuItem::linkToCrud('Measures', 'fas fa-weight', Measure::class),
                MenuItem::linkToCrud('Images', 'fas fa-image', Image::class),
                MenuItem::linkToCrud('Product Balance', 'fas fa-balance-scale', ProductBalance::class),
                MenuItem::linkToCrud('Prices', 'fas fa-dollar-sign', Price::class),
                MenuItem::linkToCrud('Country', 'fas fa-flag', Country::class),
                MenuItem::linkToCrud('Cart', 'fas fa-shopping-cart', Cart::class),
                MenuItem::linkToCrud('Wishlist', 'fas fa-heart', WishList::class),
                MenuItem::linkToCrud('Tag', 'fas fa-tags', Tag::class),
                MenuItem::section('Orders'),
                MenuItem::linkToCrud('Order', 'fas fa-file-invoice', Order::class),
                MenuItem::linkToCrud('Product Order List', 'fas fa-archive', ProductOrderList::class),
                MenuItem::section('Product Supply'),
                MenuItem::linkToCrud('Product Supply', 'fas fa-file-invoice', ProductSupply::class),
                MenuItem::linkToCrud('Product Supply List', 'fas fa-archive', ProductSupplyList::class),
            ])
        ];
    }

    public function configureUserMenu(UserInterface $user): \EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu
    {

        return parent::configureUserMenu($user)
            ->setName($user->getFirstName())
            ->displayUserName(true)
            ->displayUserAvatar(false)
            ->setGravatarEmail($user->getEmail());
            // you can use any type of menu item, except submenus

    }
}
