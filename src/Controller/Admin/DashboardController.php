<?php

namespace App\Controller\Admin;

use App\Controller\EACrudControllers\UserCrudController;
use App\Entity\Color;
use App\Entity\Country;
use App\Entity\Image;
use App\Entity\Measure;
use App\Entity\Order;
use App\Entity\ProductBalance;
use App\Entity\ProductOrderList;
use App\Entity\ProductsAndServices;
use App\Entity\ProductSupply;
use App\Entity\ProductSupplyList;
use App\Entity\Size;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

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
            MenuItem::subMenu('List', 'fa fa-article')->setSubItems([
                MenuItem::linkToCrud('Users', 'fas fa-user', User::class),
                MenuItem::linkToCrud('Color', 'fas fa-list', Color::class),
                MenuItem::linkToCrud('Products And Services', 'fas fa-list', ProductsAndServices::class),
                MenuItem::linkToCrud('Measures', 'fas fa-list', Measure::class),
                MenuItem::linkToCrud('Images', 'fas fa-list', Image::class),
                MenuItem::linkToCrud('Size', 'fas fa-list', Size::class),
                MenuItem::linkToCrud('Product Supply', 'fas fa-list', ProductSupply::class),
                MenuItem::linkToCrud('Product Supply List', 'fas fa-list', ProductSupplyList::class),
                MenuItem::linkToCrud('Order', 'fas fa-list', Order::class),
                MenuItem::linkToCrud('Country', 'fas fa-list', Country::class),
                MenuItem::linkToCrud('Product Balance', 'fas fa-list', ProductBalance::class),
                MenuItem::linkToCrud('Product Order List', 'fas fa-list', ProductOrderList::class),
            ])
        ];
    }
}
