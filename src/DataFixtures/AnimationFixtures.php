<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Animation;
use App\Repository\TeacherRepository;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AnimationFixtures extends Fixture implements DependentFixtureInterface
{ 
      public function __construct(protected TeacherRepository $repoTeach, protected ClassroomRepository $repoClass)
      {
        $this->repoTeach = $repoTeach;
        $this->repoClass = $repoClass;
      }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $teachers = $this->repoTeach->findAll();
        $classes = $this->repoClass->findAll();
        $count= count($teachers)-1;
        $count1= count($classes)-1;
        $lists = "";
        for ($i = 0; $i < 20; $i++) {
            foreach($faker->sentences() as $list){
                $lists .= "* ".$list."\n"; 
            }
            $animation = (new Animation())
            ->setSkills($lists)
            ->setSubject($faker->sentence())
            ->setClassAt($faker->dateTimeThisYear('+2 months'))
            ->setTeacher($teachers[rand(0, $count)])
            ->setClassroom($classes[rand(0, $count1)]);;
            $manager->persist($animation);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ClassroomFixtures::class,
            TeacherFixtures::class
        ];
    }
}
