<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Theme extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for($i = 1; $i < 10; $i++){
            $theme = new \App\Entity\Theme();
            $theme->setTitre($faker->words($faker->numberBetween(1,3),true));
            $this->addReference("theme".$i, $theme);
            $manager->persist($theme);
        }
        $manager->flush();
    }
}
