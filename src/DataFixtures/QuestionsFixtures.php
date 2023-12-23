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
        $allUsers = UserFactory::all();
        if (!empty($allUsers)) {
            foreach ($allUsers as $user) {
                QuestionFactory::createMany(3, function () use ($user) {
                    $faker = Factory::create();
                    $updatedAt = $faker->dateTimeBetween('-2 years');
                    return [
                        'author' => $user,
                        'updatedAt' =>
                            $faker->boolean(80) ?
                                \DateTimeImmutable::createFromMutable($updatedAt)
                                : null
                    ];
                });
            }
            $manager->flush();
        } else {
            throw new \Exception('No users found');
        }
    }

    public function getDependencies(): array {
        return [
            UserFixtures::class,
        ];
    }
}
