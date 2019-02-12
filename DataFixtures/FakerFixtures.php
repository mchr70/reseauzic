<?php
// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;
 
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
 
class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
 
        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
 
        // on créé 10 personnes
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setAddress($faker->streetAddress);
            $user->setCity($faker->city);
            $user->setZipCode($faker->postcode);
            $user->setAbout($faker->text);
            $user->setEmail($faker->email);
            $manager->persist($user);
        }
 
        $manager->flush();
    }
}