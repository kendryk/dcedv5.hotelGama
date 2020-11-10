<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Standard = new Category();
        $Standard->setName("Standard");
        $manager->persist($Standard);
        $this->addReference("cat-standard", $Standard);

        $lux = new Category();
        $lux->setName("Supérieur");
        $manager->persist($lux);
        $this->addReference("cat-lux", $lux);

        $manager->flush();
    }
}
