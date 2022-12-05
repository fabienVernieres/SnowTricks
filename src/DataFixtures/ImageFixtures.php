<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $image1 = new Image();
        $image1->setFigure($this->getReference('figure1'));
        $image1->setUrl("snowboard-rider-en-poudreuse-637272a711096.jpg");
        $image1->setName("Snowboard rider en poudreuse");
        $manager->persist($image1);
        $manager->flush();

        $image2 = new Image();
        $image2->setFigure($this->getReference('figure1'));
        $image2->setUrl("snowboard-63727332bcbed.jpg");
        $image2->setName("Snowboard rider");
        $manager->persist($image2);
        $manager->flush();

        $image3 = new Image();
        $image3->setFigure($this->getReference('figure3'));
        $image3->setUrl("rotation-6372759846d25.jpg");
        $image3->setName("rotation");
        $manager->persist($image3);
        $manager->flush();

        $image4 = new Image();
        $image4->setFigure($this->getReference('figure3'));
        $image4->setUrl("rotation-zoom-637275ae09b29.jpg");
        $image4->setName("rotation zoom");
        $manager->persist($image4);
        $manager->flush();

        $image5 = new Image();
        $image5->setFigure($this->getReference('figure4'));
        $image5->setUrl("flip-full-637275f2bd11a.jpg");
        $image5->setName("Flip full");
        $manager->persist($image5);
        $manager->flush();

        $image6 = new Image();
        $image6->setFigure($this->getReference('figure5'));
        $image6->setUrl("rotation-desaxee-6372762a64fae.jpg");
        $image6->setName("Rotation désaxée");
        $manager->persist($image6);
        $manager->flush();

        $image7 = new Image();
        $image7->setFigure($this->getReference('figure6'));
        $image7->setUrl("slide-63727668c03d4.jpg");
        $image7->setName("slide");
        $manager->persist($image7);
        $manager->flush();

        $image8 = new Image();
        $image8->setFigure($this->getReference('figure2'));
        $image8->setUrl("grab-jump-637276b60ab85.jpg");
        $image8->setName("grab jump");
        $manager->persist($image8);
        $manager->flush();

        $image9 = new Image();
        $image9->setFigure($this->getReference('figure7'));
        $image9->setUrl("one-foot-trick-6372770e84365.jpg");
        $image9->setName("one foot trick.jpg");
        $manager->persist($image9);
        $manager->flush();

        $image10 = new Image();
        $image10->setFigure($this->getReference('figure2'));
        $image10->setUrl("le-grab-6372796401aec.jpg");
        $image10->setName("le grab");
        $manager->persist($image10);
        $manager->flush();

        $image11 = new Image();
        $image11->setFigure($this->getReference('figure2'));
        $image11->setUrl("grab-63727975e23a4.jpg");
        $image11->setName("grab");
        $manager->persist($image11);
        $manager->flush();

        $image12 = new Image();
        $image12->setFigure($this->getReference('figure8'));
        $image12->setUrl("old-school-6373d5a37201d.jpg");
        $image12->setName("old school snowboard");
        $manager->persist($image12);
        $manager->flush();

        $image13 = new Image();
        $image13->setFigure($this->getReference('figure9'));
        $image13->setUrl("jump-6373d5d14d6b1.jpg");
        $image13->setName("jump");
        $manager->persist($image13);
        $manager->flush();

        $image14 = new Image();
        $image14->setFigure($this->getReference('figure10'));
        $image14->setUrl("slide-bar-6373d603034c4.jpg");
        $image14->setName("slide bar");
        $manager->persist($image14);
        $manager->flush();

        // references
        $this->addReference('image1', $image1);
        $this->addReference('image2', $image2);
        $this->addReference('image3', $image3);
        $this->addReference('image4', $image4);
        $this->addReference('image5', $image5);
        $this->addReference('image6', $image6);
        $this->addReference('image7', $image7);
        $this->addReference('image8', $image8);
        $this->addReference('image9', $image9);
        $this->addReference('image10', $image10);
        $this->addReference('image11', $image11);
        $this->addReference('image12', $image12);
        $this->addReference('image13', $image13);
        $this->addReference('image14', $image14);
    }

    public function getDependencies()
    {
        return [
            FigureFixtures::class,
        ];
    }
}