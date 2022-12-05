<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FigureImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $this->getReference('figure1')->setImage($this->getReference('image2'));
        $manager->persist($this->getReference('figure1'));
        $manager->flush();

        $this->getReference('figure2')->setImage($this->getReference('image10'));
        $manager->persist($this->getReference('figure2'));
        $manager->flush();

        $this->getReference('figure3')->setImage($this->getReference('image3'));
        $manager->persist($this->getReference('figure3'));
        $manager->flush();

        $this->getReference('figure4')->setImage($this->getReference('image5'));
        $manager->persist($this->getReference('figure4'));
        $manager->flush();

        $this->getReference('figure5')->setImage($this->getReference('image6'));
        $manager->persist($this->getReference('figure5'));
        $manager->flush();

        $this->getReference('figure6')->setImage($this->getReference('image7'));
        $manager->persist($this->getReference('figure6'));
        $manager->flush();

        $this->getReference('figure7')->setImage($this->getReference('image9'));
        $manager->persist($this->getReference('figure7'));
        $manager->flush();

        $this->getReference('figure8')->setImage($this->getReference('image12'));
        $manager->persist($this->getReference('figure8'));
        $manager->flush();

        $this->getReference('figure9')->setImage($this->getReference('image13'));
        $manager->persist($this->getReference('figure9'));
        $manager->flush();

        $this->getReference('figure10')->setImage($this->getReference('image14'));
        $manager->persist($this->getReference('figure10'));
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ImageFixtures::class,
        ];
    }
}