<?php

namespace App\DataFixtures;

use App\Factory\SpeciesFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpeciesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Species.json');
        $array = json_decode($file, true);
        SpeciesFactory::createSequence($array);


        $manager->flush();
    }
}
