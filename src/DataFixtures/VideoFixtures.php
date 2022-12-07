<?php

namespace App\DataFixtures;

use App\Entity\Video;
use App\Repository\FigureRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $video = new Video();
        $video->setFigure($this->getReference('figure2'));
        $video->setCode('<iframe width="560" height="315" src="https://www.youtube.com/embed/Bg1OrOsaJfE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
        $video->setName("vidéo 1");
        $manager->persist($video);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            FigureFixtures::class,
        ];
    }
}