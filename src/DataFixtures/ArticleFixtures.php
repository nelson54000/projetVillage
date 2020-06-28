<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // use the factory to create a Faker\Generator instance
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 80; $i++) {

            $Article = new Article();
            $Article
                ->setAdressImgArticle(null)
                ->setCreatedAt($faker->dateTime($max = 'now', $timezone = null))
                ->setTextArticle($faker->text(8000))
                // ->setTextArticle($faker->paragraph($nbSentences = 40, $variableNbSentences = true))  

                ->setNameArticle($faker->sentence($nbWords = 3, $variableNbWords = true));

            $manager->persist($Article);
            $manager->flush();
        }
        $manager->flush();
    }
}
