<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Sheet;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SheetFixtures extends Fixture
{ 
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $dates = mt_rand(strtotime('2010-06-01'),strtotime('2023-12-31'));
            $date = date("Y-m-d", $dates);
            $sheet= (new Sheet())
                ->setWeek($i)
                ->setStartAt(new \DateTime($date))
                ->setEndAt($faker->dateTimeInInterval($date, '+5 days'))
            ;
            $manager->persist($sheet);
        }
        $manager->flush();
    }
}
