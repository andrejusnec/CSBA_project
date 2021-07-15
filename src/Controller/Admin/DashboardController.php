<?php

namespace App\Controller\Admin;

use App\Controller\EACrudControllers\UserCrudController;
use App\Entity\Color;
use App\Entity\Image;
use App\Entity\Measure;
use App\Entity\Order;
use App\Entity\ProductsAndServices;
use App\Entity\ProductSupply;
use App\Entity\ProductSupplyList;
use App\Entity\Size;
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
        //return parent::index();

        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());

        // you can also redirect to different pages depending on the current user
//        if ('jane' === $this->getUser()->getUsername()) {
//            return $this->redirect('...');
//        }

        // you can also render some template to display a proper Dashboard
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Color', 'fas fa-list', Color::class);
        yield MenuItem::linkToCrud('ProductsAndServices', 'fas fa-list', ProductsAndServices::class);
        yield MenuItem::linkToCrud('Measures', 'fas fa-list', Measure::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-list', Image::class);
        yield MenuItem::linkToCrud('Size', 'fas fa-list', Size::class);
        yield MenuItem::linkToCrud('ProductSupply', 'fas fa-list', ProductSupply::class);
        yield MenuItem::linkToCrud('ProductSupplyList', 'fas fa-list', ProductSupplyList::class);
        yield MenuItem::linkToCrud('Order', 'fas fa-list', Order::class);
    }
}
