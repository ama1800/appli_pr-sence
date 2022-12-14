<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Student;
use App\DataFixtures\ClassroomFixtures;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class StudentFixtures extends Fixture implements DependentFixtureInterface
{ 
    public function __construct(private UserPasswordHasherInterface $encoder, protected ClassroomRepository $repo)
    {
        $this->encoder = $encoder;
        $this->repo = $repo;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $classes = $this->repo->findAll();
        $count= count($classes)-1;
        $roles = ['ROLE_STUDENT', 'ROLE_DELEGATE'];
        $j = 0;
        for ($i = 0; $i < 250; $i++) {
            $student = (new Student())
            ->setFirstName($faker->firstname())
            ->setLastName($faker->lastname())
            ->setPhone($faker->mobileNumber())
            ->setEmail($faker->freeEmail())
            ->setClassroom($classes[rand(0, $count)])
            ;
            $password = $this->encoder->hashPassword($student, '123456789');
            $student->setPassword($password);

            if ($i == 0 || $i == $j+20) {
                $student->setRoles([$roles[1]]);
            } else {

                $student->setRoles([$roles[0]]);
            }
            $manager->persist($student);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ClassroomFixtures::class
        ];
    }
}
