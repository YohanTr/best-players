<?php

namespace App\DataFixtures;

use App\DataFixtures\ClubFixtures;
use App\Entity\Player;
use App\DataFixtures\CountryFixtures;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Faker\Factory;

class PlayerFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_OBJECT = 200;

    public function getDependencies(): array
    {
        return [CountryFixtures::class, ClubFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $slugify = new Slugify();
        for ($i = 1; $i <= self::NB_OBJECT; $i++) {


            $country = $this->getReference('country_' . $faker->numberBetween(1, 50));
            $club = $this->getReference('club_' . $faker->numberBetween(1, 50));
            $player = new Player();
            $name = $faker->name();
            $slug = $slugify->slugify($name);
            $player->setName($name);
            $player->setSlug($slug);
            $player->setAge($faker->numberBetween(15, 40));
            $player->setGamePlayed($faker->numberBetween(0, 900));
            $player->setGoalScored($faker->numberBetween(0, 200));
            $player->setKeyPass($faker->numberBetween(0, 200));
            $player->setCountry($country);
            $player->setClub($club);
            $manager->persist($player);
            $this->addReference('player_' . $i, $player);

        }
        $manager->flush();
    }
}
