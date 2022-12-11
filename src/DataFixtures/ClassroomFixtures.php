<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Classroom;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClassroomFixtures extends Fixture
{ 
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
        $year = array_rand(range(2010,2023));
        $month = array_rand(range(1,12));
        $day = array_rand(range(1,28));
            $classroom = (new Classroom())
            ->setName($faker->firstname())
            ->setStartAt($faker->date($year.'-'.$month.'-'.$day))
            ->setEndAt($faker->date($year.'-'.$month.'-'.$day));
            $manager->persist($classroom);
        }
        $manager->flush();
    }
}
