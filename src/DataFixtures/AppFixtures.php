<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $firstname = $faker->firstName();
            $lastname = $faker->lastName();

            $emailFirstname = strtolower(str_replace(['é', 'ê', 'è', 'ë', 'à', 'â', 'ç'], ['e','e','e','e','a','a','c'], $firstname));
            $emailLastname = strtolower(str_replace(['é', 'ê', 'è', 'ë', 'à', 'â', 'ç'], ['e','e','e','e','a','a','c'], $lastname));
            $domain = [
                "gmail.com",
                "hotmail.com",
                "orange.fr",
                "bbox.fr",
                "free.fr",
                "live.com",
                "laposte.net",
            ];

            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail("{$emailFirstname}.{$emailLastname}@" . $domain[array_rand($domain)]);
            $user->setPassword($faker->password);
            $user->setRoles(["ROLE_USER"]);

            $manager->persist($user);
        }

        $manager->flush();
    }
}