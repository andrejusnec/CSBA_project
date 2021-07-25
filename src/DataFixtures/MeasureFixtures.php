<?php

namespace App\DataFixtures;

use App\Entity\Measure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MeasureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $valueArr = [];
        $valueArr[] = ['MMT', 'CMT', 'MTR', 'GRM', 'KGM','H87', '778'];
        $valueArr[] = ['mm', 'cm', 'm', 'g', 'kg', 'pc', 'pack'];
        $valueArr[] = ['Millimetre', 'Centimetre', 'Metre', 'Gram', 'Kilogram', 'Piece', 'Package'];

        for ($i = 0; $i < count($valueArr[0]); $i++) {
            $measure = new Measure();
            $measure->setCode($valueArr[0][$i]);
            $measure->setShortName($valueArr[1][$i]);
            $measure->setFullName($valueArr[2][$i]);
            $manager->persist($measure);
        }
        $manager->flush();
    }
}
