<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\ClubFixtures;
use App\DataFixtures\PlayerFixtures;
use Faker\Factory;

class CountryFixtures extends Fixture
{
    public const NB_OBJECT = 50;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 1; $i <= self::NB_OBJECT; $i++) {
            $country = new Country();
            $country->setName($faker->country);
            $this->addReference('country_' . $i, $country);
            $manager->persist($country);
        }
        $manager->flush();
    }
}
