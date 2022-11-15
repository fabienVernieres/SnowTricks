<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 50; $i++) {
        //     $user = new User();
        //     $user->setName($faker->name);
        //     $user->setEmail($faker->email);
        //     $user->setPassword($this->userPasswordHasher->hashPassword($user, '123456'));
        //     $user->setAvatar($faker->numberBetween(1, 20) . '.jpg');
        //     $user->setIsVerified = 1;

        //     $manager->persist($user);
        // }


        // $manager->flush();
    }
}