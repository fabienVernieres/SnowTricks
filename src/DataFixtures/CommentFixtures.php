<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use App\Repository\UserRepository;
use App\Repository\FigureRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CommentFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher, UserRepository $userRepository, FigureRepository $figureRepository)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->userRepository = $userRepository;
        $this->figureRepository = $figureRepository;
    }

    public function load(ObjectManager $manager): void
    {
        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 100; $i++) {
        //     $figure = $this->figureRepository->find($faker->numberBetween(1, 10));
        //     $author = $this->userRepository->find($faker->numberBetween(1, 52));

        //     $comment = new Comment();
        //     $comment->setFigure($figure);
        //     $comment->setAuthor($author);
        //     $comment->setContent($faker->text(300));
        //     $comment->setCreationDate($faker->dateTimeThisDecade);

        //     $manager->persist($comment);
        // }


        // $manager->flush();
    }
}