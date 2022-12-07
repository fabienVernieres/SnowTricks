<?php

namespace App\DataFixtures;

use App\Entity\Group;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupFixtures extends Fixture
{
    public function __construct()
    {
    }

    public function load(ObjectManager $manager): void
    {
        $group1 = new Group();
        $group1->setName("Rotation");
        $group1->setSlug("rotation");
        $manager->persist($group1);
        $manager->flush();

        $group2 = new Group();
        $group2->setName("Saut");
        $group2->setSlug("saut");
        $manager->persist($group2);
        $manager->flush();

        $group3 = new Group();
        $group3->setName("Slide");
        $group3->setSlug("slide");
        $manager->persist($group3);
        $manager->flush();

        $group4 = new Group();
        $group4->setName("Ride");
        $group4->setSlug("ride");
        $manager->persist($group4);
        $manager->flush();

        $group5 = new Group();
        $group5->setName("Grab");
        $group5->setSlug("grab");
        $manager->persist($group5);
        $manager->flush();

        // references
        $this->addReference('group1', $group1);
        $this->addReference('group2', $group2);
        $this->addReference('group3', $group3);
        $this->addReference('group4', $group4);
        $this->addReference('group5', $group5);
    }
}