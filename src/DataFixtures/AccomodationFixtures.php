<?php

namespace App\DataFixtures;

use App\Entity\Accomodation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AccomodationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $Accomodation1 = new Accomodation();
        $Accomodation1->setPhoto("room1.jpeg");
        $Accomodation1->setBeds(1);
        $Accomodation1->setPersons(2);
        $Accomodation1->setSize(40);
        $Accomodation1->setPrice(90);
        $Accomodation1->setDescription("Lorem ipsum dolor sit amet, 
        consectetur adipisicing elit. Adipisci atque, consectetur 
        ");
        $Accomodation1->setType($this->getReference("type-room"));
        $Accomodation1->setCategory($this->getReference("cat-standard"));
        $manager->persist($Accomodation1);
        $this->addReference("Accomodation-1",$Accomodation1);

        $Accomodation2 = new Accomodation();
        $Accomodation2->setPhoto("room2.jpeg");
        $Accomodation2->setBeds(1);
        $Accomodation2->setPersons(2);
        $Accomodation2->setSize(60);
        $Accomodation2->setPrice(120);
        $Accomodation2->setDescription("Lorem ipsum dolor sit amet, 
        consectetur adipisicing elit. Adipisci atque, consectetur 
        ");
        $Accomodation2->setType($this->getReference("type-room"));
        $Accomodation2->setCategory($this->getReference("cat-standard"));
        $manager->persist($Accomodation2);
        $this->addReference("Accomodation-2",$Accomodation2);

        $Accomodation3 = new Accomodation();
        $Accomodation3->setPhoto("room3.jpeg");
        $Accomodation3->setBeds(2);
        $Accomodation3->setPersons(4);
        $Accomodation3->setSize(65);
        $Accomodation3->setPrice(120);
        $Accomodation3->setDescription("Lorem ipsum dolor sit amet, 
        consectetur adipisicing elit. Adipisci atque, consectetur 
        ");
        $manager->persist($Accomodation2);
        $Accomodation3->setType($this->getReference("type-appart"));;
        $Accomodation3->setCategory($this->getReference("cat-standard"));
        $this->addReference("Accomodation-3",$Accomodation3);

        $Accomodation4 = new Accomodation();
        $Accomodation4->setPhoto("room4.jpeg");
        $Accomodation4->setBeds(1);
        $Accomodation4->setPersons(2);
        $Accomodation4->setSize(33);
        $Accomodation4->setPrice(80);
        $Accomodation4->setDescription("Lorem ipsum dolor sit amet, 
        consectetur adipisicing elit. Adipisci atque, consectetur 
        ");
        $Accomodation4->setType($this->getReference("type-room"));
        $Accomodation4->setCategory($this->getReference("cat-standard"));
        $manager->persist($Accomodation2);
        $this->addReference("Accomodation-4",$Accomodation4);

        $Accomodation5 = new Accomodation();
        $Accomodation5->setPhoto("room5.jpeg");
        $Accomodation5->setBeds(1);
        $Accomodation5->setPersons(2);
        $Accomodation5->setSize(50);
        $Accomodation5->setPrice(110);
        $Accomodation5->setDescription("Lorem ipsum dolor sit amet, 
        consectetur adipisicing elit. Adipisci atque, consectetur 
        ");
        $Accomodation5->setType($this->getReference("type-room"));
        $Accomodation5->setCategory($this->getReference("cat-lux"));
        $manager->persist($Accomodation5);
        $this->addReference("Accomodation-5",$Accomodation5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            CategoryFixtures::class,
            TypeFixtures::class,

        ];

    }
}
