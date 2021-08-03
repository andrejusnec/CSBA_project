<?php

namespace App\Controller\Admin;

use App\Controller\EACrudControllers\UserCrudController;
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
use App\Entity\User;
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
            //MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::subMenu('List', 'fa fa-list')->setSubItems([
                MenuItem::linkToCrud('Users', 'fas fa-user', User::class),
                MenuItem::linkToCrud('Products And Services', 'fas fa-angle-right', ProductsAndServices::class),
                MenuItem::linkToCrud('Measures', 'fas fa-angle-right', Measure::class),
                MenuItem::linkToCrud('Images', 'fas fa-angle-right', Image::class),
                MenuItem::linkToCrud('Product Supply', 'fas fa-angle-right', ProductSupply::class),
                MenuItem::linkToCrud('Product Supply List', 'fas fa-angle-right', ProductSupplyList::class),
                MenuItem::linkToCrud('Order', 'fas fa-angle-right', Order::class),
                MenuItem::linkToCrud('Country', 'fas fa-angle-right', Country::class),
                MenuItem::linkToCrud('Product Balance', 'fas fa-angle-right', ProductBalance::class),
                MenuItem::linkToCrud('Product Order List', 'fas fa-angle-right', ProductOrderList::class),
                MenuItem::linkToCrud('Prices', 'fas fa-angle-right', Price::class),
            ])
        ];
    }

    public function configureUserMenu(UserInterface $user): \EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            ->setName($user->getFirstName())
            ->displayUserName(true)

            ->setAvatarUrl('https://...')
            ->displayUserAvatar(false)
            ->setGravatarEmail($user->getEmail());
            // you can use any type of menu item, except submenus

    }
}
