<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $booking1 = new Booking();
        $booking1->setDateStart (new\DateTime("2020/12/25"));
        $booking1->setDateEnd(new\DateTime("2020/12/28"));
        $booking1->setUser($this->getReference("user-chuck"));
        $booking1->setAccomodation($this->getReference("Accomodation-1"));
        $this->addReference("booking1", $booking1);
        $manager->persist($booking1);

        $booking2 = new Booking();
        $booking2->setDateStart (new\DateTime("2021/04/12"));
        $booking2->setDateEnd(new\DateTime("2021/05/01"));
        $booking2->setUser($this->getReference("user-jeanne"));
        $booking2->setAccomodation($this->getReference("Accomodation-2"));
        $this->addReference("booking2", $booking2);
        $manager->persist($booking2);

        $booking3 = new Booking();
        $booking3->setDateStart (new\DateTime("2021/01/12"));
        $booking3->setDateEnd(new\DateTime("2021/01/22"));
        $booking3->setUser($this->getReference("user-decker"));
        $booking3->setAccomodation($this->getReference("Accomodation-3"));
        $this->addReference("booking3", $booking3);
        $manager->persist($booking3);


        $manager->flush();
    }
    public function getDependencies()
    {
        return[
            UserFixtures::class,
            AccomodationFixtures::class,

        ];

    }
}
