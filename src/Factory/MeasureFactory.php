<?php

namespace App\Factory;

use App\Entity\Measure;
use App\Repository\MeasureRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Measure|Proxy createOne(array $attributes = [])
 * @method static Measure[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Measure|Proxy find($criteria)
 * @method static Measure|Proxy findOrCreate(array $attributes)
 * @method static Measure|Proxy first(string $sortedField = 'id')
 * @method static Measure|Proxy last(string $sortedField = 'id')
 * @method static Measure|Proxy random(array $attributes = [])
 * @method static Measure|Proxy randomOrCreate(array $attributes = [])
 * @method static Measure[]|Proxy[] all()
 * @method static Measure[]|Proxy[] findBy(array $attributes)
 * @method static Measure[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Measure[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MeasureRepository|RepositoryProxy repository()
 * @method Measure|Proxy create($attributes = [])
 */
final class MeasureFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }
    public static function getMeasureValues() : array
    {
        $valueArr = [];
        $valueArr[] = ['MMT', 'CMT', 'MTR', 'GRM', 'KGM','H87', '778'];
        $valueArr[] = ['mm', 'cm', 'm', 'g', 'kg', 'pc', 'pack'];
        $valueArr[] = ['Millimetre', 'Centimetre', 'Metre', 'Gram', 'Kilogram', 'Piece', 'Package'];
        return $valueArr;
    }
    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'code' => self::faker()->unique->word(),
            'short_name' => self::faker()->name(),
            'full_name' => self::faker()->lastName(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Measure $measure) {})
        ;
    }

    protected static function getClass(): string
    {
        return Measure::class;
    }
}
