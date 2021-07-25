<?php

namespace App\Factory;

use App\Entity\ProductsAndServices;
use App\Repository\ProductsAndServicesRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static ProductsAndServices|Proxy createOne(array $attributes = [])
 * @method static ProductsAndServices[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static ProductsAndServices|Proxy find($criteria)
 * @method static ProductsAndServices|Proxy findOrCreate(array $attributes)
 * @method static ProductsAndServices|Proxy first(string $sortedField = 'id')
 * @method static ProductsAndServices|Proxy last(string $sortedField = 'id')
 * @method static ProductsAndServices|Proxy random(array $attributes = [])
 * @method static ProductsAndServices|Proxy randomOrCreate(array $attributes = [])
 * @method static ProductsAndServices[]|Proxy[] all()
 * @method static ProductsAndServices[]|Proxy[] findBy(array $attributes)
 * @method static ProductsAndServices[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProductsAndServices[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProductsAndServicesRepository|RepositoryProxy repository()
 * @method ProductsAndServices|Proxy create($attributes = [])
 */
final class ProductsAndServicesFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }
    public function onlyCatalogAndNoParent() : self {
        return $this->addState(['isCatalog' => true, 'measure_code' => null, 'isProduct' => false, 'parent' => null]);
    }
    public function onlyCatalogWithParent($parent) : self {

        return $this->addState(['isCatalog' => true, 'measure_code' => null, 'isProduct' => false, 'parent' => $parent]);
    }
    public function onlyProduct($parent) : self {

        return $this->addState(['parent' => $parent, 'fontawesome_icon' => null]);
    }
    public static function middleCatalogs() : array
    {
        $rezArray = [];
        $middleCatalogs = ProductsAndServicesFactory::all();
        for ($x = 0; $x < count($middleCatalogs); $x++) {
            if($middleCatalogs[$x]->getIsCatalog() && $middleCatalogs[$x]->getParent() !== null) {
                $rezArray[] = $middleCatalogs[$x];
            }
        }
        return $rezArray;
    }
    protected function getDefaults(): array
    {
        $values = ['female' => 'fa fa-female', 'male' => 'fa fa-male', 'child' => 'fa fa-child', 'home' => 'fa fa-home'
        ,'shop' => 'fa fa-shopping-bag'];
        return [
            'isProduct' => true,
            'isActive' => self::faker()->boolean(100),
            'title' => self::faker()->text(20),
            'isCatalog' => false,
            'measure_code' => MeasureFactory::random(),
            'fontawesome_icon' => self::faker()->randomElement($values)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(ProductsAndServices $productsAndServices) {})
        ;
    }

    protected static function getClass(): string
    {
        return ProductsAndServices::class;
    }
}
