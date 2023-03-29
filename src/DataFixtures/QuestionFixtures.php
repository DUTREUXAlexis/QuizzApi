<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use http\QueryString;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create("fr_FR");
        for($i = 0; $i < 2000;$i++)
        {
            $Question = new Question();
            $Question->setText($faker->sentence);
            $Question->setReponseJuste($faker->word);
            $Question->setReponse(['R1','R2','R3']);
            $Question->setIdtheme($this->getReference('Theme :'.$faker->randomDigit()));
            $this->getReference('Theme :'.$i);
            $manager->persist($Question);
        }
        $manager->flush();
    }
}
