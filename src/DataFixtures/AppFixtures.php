<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Module;
use App\Entity\Prof;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create();

        $etudiants = [];

        for ($i = 0; $i < 30; $i++) {
            $etudiant = new Etudiant();
            $etudiant->setFirstname($faker->firstName);
            $etudiant->setLastname($faker->lastName);
            $etudiant->setEmail($faker->email);
            $etudiant->setRoles(["ROLE_STUDENT"]);
            $etudiant->setPassword(123456789);
            $etudiant->setGrade('L1');
            $etudiant->setPhoto($faker->imageUrl());
            $manager->persist($etudiant);
            $etudiants[] = $etudiant;
        }

        $modules = [];
        $randModule = ['INFO_100', 'LANG_100', 'MATH_100', 'COM_100'];
        $randCateg = ['COMM', 'RSI', 'IDEV'];

        for ($i = 0; $i < 5; $i++) {
            $module = new Module();
            $module->setNom(array_rand($randModule, 1));
            $module->setCategory(array_rand($randCateg, 1));
            $manager->persist($module);
            $modules[] = $module;
        }

        $profs = [];

        for ($i = 0; $i < 10; $i++) {
            $prof = new Prof();
            $prof->setEmail($faker->email);
            $prof->setFirstname($faker->firstName);
            $prof->setLastname($faker->lastName);
            $prof->setRoles(['ROLE_ENS']);
            $prof->setPassword(12345789);
            $prof->setPhoto($faker->imageUrl());
            $prof->addModule($modules[$faker->numberBetween(0, 4)]);
            $manager->persist($prof);
            $profs[] = $prof;
        }

        $manager->flush();
    }
}
