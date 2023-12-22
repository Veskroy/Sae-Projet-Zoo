<?php

namespace App\DataFixtures;

use App\Factory\QuestionFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class QuestionsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        QuestionFactory::createMany(10, function () {
            $faker = Factory::create();
            $updatedAt = $faker->dateTimeBetween('-2 years');
            return [
                'author' => UserFactory::random(),
                'updatedAt' =>
                    $faker->boolean(80) ?
                        \DateTimeImmutable::createFromMutable($updatedAt)
                        : null
            ];
        });

        $manager->flush();
    }

    public function getDependencies(): array {
        return [
            UserFixtures::class,
        ];
    }
}
