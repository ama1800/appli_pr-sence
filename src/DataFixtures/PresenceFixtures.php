<?php

namespace App\DataFixtures;


use App\Entity\Presence;
use App\DataFixtures\SheetFixtures;
use App\Repository\SheetRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PresenceFixtures extends Fixture implements DependentFixtureInterface
{ 
    public function __construct(protected SheetRepository $repo)
      {
        $this->repo = $repo;
      }

    public function load(ObjectManager $manager)
    {
        $sheets = $this->repo->findAll();
        for ($i = 0; $i < 20; $i++) {
            $presence= (new Presence())
                ->setSheet($sheets[$i])
            ;
            $manager->persist($presence);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SheetFixtures::class
        ];
    }
}
