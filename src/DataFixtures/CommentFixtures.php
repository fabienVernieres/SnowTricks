<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $figure = $this->getReference('figure' . $faker->numberBetween(1, 10));
            $author = $this->getReference('user' . $faker->numberBetween(1, 50));

            $comment = new Comment();
            $comment->setFigure($figure);
            $comment->setAuthor($author);
            $comment->setContent($faker->text(300));
            $comment->setCreationDate($faker->dateTimeThisDecade);

            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FigureFixtures::class,
        ];
    }
}