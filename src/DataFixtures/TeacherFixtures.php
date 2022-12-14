<?php

namespace App\DataFixtures;

use App\Entity\Classroom;
use Faker\Factory;
use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TeacherFixtures extends Fixture implements DependentFixtureInterface
{ 
    public function __construct(private UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $classes= $manager->getRepository(Classroom::class)->findAll();
        //dd($classes);
        $roles = ['ROLE_TEACHER', 'ROLE_GERANT'];
        for ($i = 0; $i < 25; $i++) {
            $teatcher = (new Teacher())
                ->setFirstName($faker->firstname())
                ->setLastName($faker->lastname())
                ->setPhone($faker->mobileNumber())
                ->setEmail($faker->safeEmail())
                ;
            $password = $this->encoder->hashPassword($teatcher, '123456789');
            $teatcher->setPassword($password);

            if ($i == 0) {
                $teatcher->setRoles(['ROLE_SUPER_ADMIN']);
            } else {

                $teatcher->setRoles([$roles[rand(0, 1)]]);
            }
            $manager->persist($teatcher);
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
