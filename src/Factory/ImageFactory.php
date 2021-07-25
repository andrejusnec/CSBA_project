<?php

namespace App\Factory;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Image|Proxy createOne(array $attributes = [])
 * @method static Image[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Image|Proxy find($criteria)
 * @method static Image|Proxy findOrCreate(array $attributes)
 * @method static Image|Proxy first(string $sortedField = 'id')
 * @method static Image|Proxy last(string $sortedField = 'id')
 * @method static Image|Proxy random(array $attributes = [])
 * @method static Image|Proxy randomOrCreate(array $attributes = [])
 * @method static Image[]|Proxy[] all()
 * @method static Image[]|Proxy[] findBy(array $attributes)
 * @method static Image[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Image[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ImageRepository|RepositoryProxy repository()
 * @method Image|Proxy create($attributes = [])
 */
final class ImageFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        //dd(self::faker()->image('public/uploads/images', 640, 480,));
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'file_name' => self::faker()->image('public/uploads/images/', 640, 480, null, false),
            'isActive' => true,
            'title' => self::faker()->text(rand(5, 25)),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Image $image) {})
        ;
    }

    protected static function getClass(): string
    {
        return Image::class;
    }
}
