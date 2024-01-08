<?php

namespace App\DataFixtures;

use App\Factory\TicketFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

;

class TicketFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       TicketFactory::createMany(5);

    }
}
