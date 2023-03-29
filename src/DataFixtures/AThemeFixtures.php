<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Theme;
use Faker\Factory;

class AThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create("fr_FR");
        for($i = 0; $i < 2000;$i++)
        {
            $theme = new theme();
            $theme->setLibelle('Theme n°'.$i);
            $theme->setDescription($faker->paragraphs(3,true));
            $this->addReference('Theme :'.$i,$theme);
            $manager->persist($theme);
        }
        $manager->flush();
    }
}
