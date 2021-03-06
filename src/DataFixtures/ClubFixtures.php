<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClubFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_OBJECT = 50;

    public function getDependencies(): array
    {
        return [CountryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();
        for ($i = 1; $i <= self::NB_OBJECT; $i++) {
            $country = $this->getReference('country_' . $faker->numberBetween(1, 50));
            $club = new Club();
            $name = $faker->city();
            $slug = $slugify->slugify($name);
            $club->setName($name);
            $club->setSlug($slug);
            $club->setCountry($country);
            $manager->persist($club);
            $this->addReference('club_' . $i, $club);
        }
        $manager->flush();
    }
}
