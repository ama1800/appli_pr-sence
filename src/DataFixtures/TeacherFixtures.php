<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Teatcher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TeacherFixtures extends Fixture
{ 
    public function __construct(private UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $roles = ['ROLE_TEACHER', 'ROLE_GERANT'];
        for ($i = 0; $i < 25; $i++) {
            $teatcher = (new Teatcher())
                ->setFirstName($faker->firstname())
                ->setLastName($faker->lastname())
                ->setPhone($faker->mobileNumber())
                ->setEmail($faker->freeEmail());
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
}
