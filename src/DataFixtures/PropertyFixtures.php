<?php

namespace App\DataFixtures;

use App\Entity\Property;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use Faker\Factory;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\DateTime as ConstraintsDateTime;

class PropertyFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        // use the factory to create a Faker\Generator instance
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 80; $i++) {


        
            $property = new Property();
            $property
                ->setTitle($faker->streetAddress())
                ->setPrice($faker->numberBetween(30000, 1000000))
                ->setRooms($faker->numberBetween(1, 10))
                ->setBedrooms($faker->numberBetween(1, 4))
                ->setDescription($faker->text(200))
                ->setSurface($faker->numberBetween(80, 300))
                ->setFloor($faker->numberBetween(0, 5))
                ->setHeat(1)
                ->setCity($faker->city())
                ->setAdress($faker->streetAddress())
                ->setPostalCode($faker->postcode())
                ->setUpdatedAt($faker->dateTime($max = 'now', $timezone = null));

            $manager->persist($property);
            $manager->flush();

        }
    }
}
