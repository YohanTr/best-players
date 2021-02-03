<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Cocur\Slugify\Slugify;
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
        $slugify = new Slugify();
        for ($i = 1; $i <= self::NB_OBJECT; $i++) {
            $country = new Country();
            $name = $faker->name();
            $slug = $slugify->slugify($name);
            $country->setName($name);
            $country->setSlug($slug);
            $this->addReference('country_' . $i, $country);
            $manager->persist($country);
        }
        $manager->flush();
    }
}
