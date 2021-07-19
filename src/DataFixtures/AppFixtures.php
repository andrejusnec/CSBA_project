<?php

namespace App\DataFixtures;

use App\Factory\ColorFactory;
use App\Factory\CountryFactory;
use App\Factory\ImageFactory;
use App\Factory\MeasureFactory;
use App\Factory\OrderFactory;
use App\Factory\ProductBalanceFactory;
use App\Factory\ProductOrderListFactory;
use App\Factory\ProductsAndServicesFactory;
use App\Factory\ProductSupplyFactory;
use App\Factory\ProductSupplyListFactory;
use App\Factory\SizeFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            MeasureFixtures::class,
        ];
    }
    public function load(ObjectManager $manager)
    {
        ColorFactory::createMany(20);
        SizeFactory::createMany(6);
        ProductsAndServicesFactory::new()
            ->onlyCatalogAndNoParent()
            ->many(5)
            ->create();

        $topCatalogs = ProductsAndServicesFactory::findBy(['isCatalog' => true, 'parent' => null]);
        $length = count($topCatalogs);
        for ($i = 0; $i < $length; $i++) {
            ProductsAndServicesFactory::new()
                ->onlyCatalogWithParent($topCatalogs[rand(0, $length - 1)])
                ->create();
        }

        $middleCatalogs = ProductsAndServicesFactory::middleCatalogs();
        $length = count($middleCatalogs);
        for ($i = 0; $i < $length; $i++) {
            ProductsAndServicesFactory::new()
                ->onlyProduct($middleCatalogs[rand(0, $length - 1)])
                ->create();
        }

        ImageFactory::createMany(5,
            function() {
                return ['product' => ProductsAndServicesFactory::random()];
            });
        CountryFactory::createMany(10);
        ProductSupplyFactory::createMany(10);
        ProductSupplyListFactory::createMany(5);
        UserFactory::createMany(10);
        OrderFactory::createMany(12,
            function() {
                return ['user' => UserFactory::randomOrCreate(), 'country' => CountryFactory::randomOrCreate()];
            });
        ProductBalanceFactory::createMany(10);
        ProductOrderListFactory::createMany(10);
    }
}
