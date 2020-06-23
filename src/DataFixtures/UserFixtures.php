<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;




class UserFixtures extends Fixture
{

    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 7; $i++) {
        $newUser = new User();
        $newUser
           ->setUsername($faker->name())
           ->setRoles(['ROLE_USER'])
           ->setPassword($faker->name());

             // $em = $this->getDoctrine()->getManager();

         $manager->persist($newUser);
         $manager->flush();

        }
    }

}
