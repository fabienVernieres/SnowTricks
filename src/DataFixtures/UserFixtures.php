<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setName('JIMMY SWEAT');
        $user1->setEmail('contact@snowtricks.com');
        $user1->setPassword($this->userPasswordHasher->hashPassword($user1, '123456'));
        $user1->setAvatar('1.jpg');
        $user1->setIsVerified(1);
        $manager->persist($user1);

        $this->addReference(self::ADMIN_USER_REFERENCE, $user1);


        $manager->flush();

        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 51; $i++) {
            $user[$i] = new User();
            $user[$i]->setName(strtoupper($faker->userName));
            $user[$i]->setEmail($faker->email);
            $user[$i]->setPassword($this->userPasswordHasher->hashPassword($user[$i], $faker->password));
            $user[$i]->setAvatar($faker->numberBetween(1, 20) . '.jpg');
            $user[$i]->setIsVerified(1);

            $manager->persist($user[$i]);
            $this->addReference('user' . $i, $user[$i]);
        }


        $manager->flush();
    }
}