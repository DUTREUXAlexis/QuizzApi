<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class QuestionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        for($i = 1; $i < 100; $i++){
            $question = new \App\Entity\Question();
            $question->setTheme($this->getReference("theme".$faker->numberBetween(1,9)))
                ->setTexte($faker->paragraph(1)." ?")
                ->setReponses(["réponse 1","réponse 2","réponse 3","réponse 4"])
                ->setReponseJuste("réponse 1");
            $manager->persist($question);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            Theme::class
        ];
    }
}
