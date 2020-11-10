<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class PhotoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $photo1 = new Photo();
        $photo1->setFilename( "room1.jpeg");
        $photo1->setAlt("photo1");
        $photo1->setAccomodation($this->getReference("Accomodation-1"));
        $manager->persist($photo1);
        $this->addReference("photo1", $photo1);

        $photo1n1 = new Photo();
        $photo1n1->setFilename( "room1-1.jpeg");
        $photo1n1->setAlt("photo1n1");
        $photo1n1->setAccomodation($this->getReference("Accomodation-1"));
        $manager->persist($photo1n1);
        $this->addReference("photo1n1", $photo1n1);

        $photo2 = new Photo();
        $photo2->setFilename('room2.jpeg');
        $photo2->setAlt("photo2");
        $photo2->setAccomodation($this->getReference("Accomodation-2"));
        $manager->persist($photo2);
        $this->addReference("photo2", $photo2);

        $photo2n1 = new Photo();
        $photo2n1->setFilename('room2-1.jpeg');
        $photo2n1->setAlt("photo2n1");
        $photo2n1->setAccomodation($this->getReference("Accomodation-2"));
        $manager->persist($photo2n1);
        $this->addReference("photo2n1", $photo2n1);

        $photo2n2 = new Photo();
        $photo2n2->setFilename('room2-2.jpeg');
        $photo2n2->setAlt("photo2n2");
        $photo2n2->setAccomodation($this->getReference("Accomodation-2"));
        $manager->persist($photo2n2);
        $this->addReference("photo2n2", $photo2n2);


        $photo3 = new Photo();
        $photo3->setFilename('room3.jpeg');
        $photo3->setAlt("photos3");
        $photo3->setAccomodation($this->getReference("Accomodation-3"));
        $manager->persist($photo3);
        $this->addReference("photos3", $photo3);

        $photo4 = new Photo();
        $photo4->setFilename('room4.jpeg');
        $photo4->setAlt("photos4");
        $photo4->setAccomodation($this->getReference("Accomodation-4"));
        $manager->persist($photo4);
        $this->addReference("photos4", $photo4);

        $photo5 = new Photo();
        $photo5->setFilename('room5.jpeg');
        $photo5->setAlt("photos5");
        $photo5->setAccomodation($this->getReference("Accomodation-5"));
        $manager->persist($photo5);
        $this->addReference("photos5", $photo5);

        $manager->flush();
    }
    public function getDependencies()
    {
        return[

            AccomodationFixtures::class,

        ];

    }



}
