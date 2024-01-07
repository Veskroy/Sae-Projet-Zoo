<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Animal.json');
        $array = json_decode($file, true);
        AnimalFactory::createSequence($array);


        $manager->flush();
    }
}
