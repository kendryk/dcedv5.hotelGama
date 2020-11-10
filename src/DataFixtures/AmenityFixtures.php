<?php

namespace App\DataFixtures;

use App\Entity\Amenity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AmenityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $kitchen = new Amenity();
        $kitchen->setName("Cuisine");
        $kitchen->setIcon("fa fa-cutlery");
        $this->addReference("amn-kitchen", $kitchen);
        $manager->persist($kitchen);

        $access = new Amenity();
        $access->setName("Accessibilité");
        $access->setIcon("fa fa-wheelchair");
        $this->addReference("amn-access", $access);
        $manager->persist($access);

        $wifi = new Amenity();
        $wifi->setName("WiFi");
        $wifi->setIcon("fa fa-wifi");
        $this->addReference("amn-wifi", $wifi);
        $manager->persist($wifi);

        $shower = new Amenity();
        $shower->setName("Douche");
        $shower->setIcon("fa fa-shower");
        $this->addReference("amn-shower", $shower);
        $manager->persist($shower);

        $coffee = new Amenity();
        $coffee->setName("Machine à café");
        $coffee->setIcon("fa fa-coffee");
        $this->addReference("amn-coffee", $coffee);
        $manager->persist($coffee);

        $manager->flush();
    }
}
