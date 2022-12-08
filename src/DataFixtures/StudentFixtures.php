<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class StudentFixtures extends Fixture
{ 
    public function __construct(private UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $roles = ['ROLE_Student', 'ROLE_delegate'];
        $j = 0;
        for ($i = 0; $i < 250; $i++) {
            $student = (new Student())
            ->setFirstName($faker->firstname())
            ->setLastName($faker->lastname())
           ->setPhone($faker->mobileNumber())
            ->setEmail($faker->freeEmail());
            $password = $this->encoder->hashPassword($student, '123456789');
            $student->setPassword($password);

            if ($i == 0 && $i == $j+20) {
                $student->setRoles([$roles[1]]);
            } else {

                $student->setRoles([$roles[0]]);
            }
            $manager->persist($student);
        }


        $manager->flush();
    }
}
