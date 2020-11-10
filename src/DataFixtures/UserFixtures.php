<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function  __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $admin = new User();
        $admin->setEmail("cedric.mace@live.fr");
        $admin->setFirstName("Cédric");
        $admin->setLastName("Macé");
        $admin->setRoles(["ROLE_ADMIN"]);
        $password = $this->encoder->encodePassword($admin,"mcedric");
        $admin->setPassword($password);
        $manager->persist($admin);
        $this->addReference("user-admin",$admin);

        $chuck = new User();
        $chuck->setEmail("chuck.maurice@live.fr");
        $chuck->setFirstName("Chuck");
        $chuck->setLastName("Maurice");
        $password = $this->encoder->encodePassword($chuck,"mchuck");
        $chuck->setPassword($password);
        $manager->persist($chuck);
        $this->addReference("user-chuck",$chuck);

        $Jeanne = new User();
        $Jeanne->setEmail("jeanne.serge@live.fr");
        $Jeanne->setFirstName("Jeanne");
        $Jeanne->setLastName("Serge");
        $password = $this->encoder->encodePassword($Jeanne,"sjeanne");
        $Jeanne->setPassword($password);
        $manager->persist($Jeanne);
        $this->addReference("user-jeanne",$Jeanne);

        $decker = new User();
        $decker->setEmail("decker.black@live.fr");
        $decker->setFirstName("decker");
        $decker->setLastName("black");
        $password = $this->encoder->encodePassword($decker,"1234");
        $decker->setPassword($password);
        $manager->persist($decker);
        $this->addReference("user-decker",$decker);




        $manager->flush();
    }

}