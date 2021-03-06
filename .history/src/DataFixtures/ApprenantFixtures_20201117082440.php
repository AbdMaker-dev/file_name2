<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use App\Entity\Apprenant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantFixtures implements ORMFixtureInterface
{
{

    private $encode;

    public function __construct(UserPasswordEncoderInterface $encode)
    {
        $this->encode = $encode;
    }

    public function load(ObjectManager $manager)
    {
        $apprenant = new Apprenant();

        $apprenant->setUsername("abd_2020");
        $apprenant->setPassword($this->encode->encodePassword($apprenant,"abd_1234"));
        $apprenant->setNom("Diouf");
        $apprenant->setPrenom("Alioune");

        dd($apprenant);

        $manager->persist($apprenant);
        $manager->flush();
    }
}