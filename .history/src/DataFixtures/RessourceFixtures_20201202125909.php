<?php

namespace App\DataFixtures;

use App\Entity\Apprenant;
use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RessourceFixtures extends Fixture
{
    
    public function load(ObjectManager $manager)
    {
        $table = ["google.com","facebook.com"];
        
        for ($i=0; $i < count($table); $i++) 
        {
            $profil = new Resou();
            $profil->setLibelle($table[$i]);
            $manager->persist($profil);
            $manager->flush();
            $this->addReference($table[$i],$profil);
        }
    }
}