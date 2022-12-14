<?php

namespace App\DataFixtures;


use App\Entity\Draw;
use App\DataFixtures\SheetFixtures;
use App\Repository\SheetRepository;
use App\DataFixtures\StudentFixtures;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class DrawFixtures extends Fixture implements DependentFixtureInterface
{ 
    public function __construct(protected StudentRepository $repoStudent, protected SheetRepository $repoSheet)
    {
      $this->repoStudent = $repoStudent;
      $this->repoSheet = $repoSheet;
    }

    public function load(ObjectManager $manager)
    {
        $students = $this->repoStudent->findAll();
        $sheets = $this->repoSheet->findAll();
        $count= count($students)-1;
        $count1= count($sheets)-1;
        for ($i = 0; $i < 20; $i++) {
            $dates = mt_rand(strtotime('2010-06-01'),strtotime('2023-12-31'));
            $date = date("Y-m-d", $dates);
            $date1 = date("Y-m-d", $dates+35000000);
            $draw= (new Draw())
                ->setStepCount(random_int(22, 33))
                ->setToSearchAt( new \DateTime($date))
                ->setSearchedAt( new \DateTime($date1))
                ->setStudent($students[rand(0, $count)])
                ->setSheet($sheets[$i])
            ;
            $manager->persist($draw);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SheetFixtures::class,
            StudentFixtures::class
        ];
    }
}
