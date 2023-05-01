<?php

namespace App\DataFixtures;

use App\Entity\Relative;
use App\DataFixtures\ZAnnonceFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RelativeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $r = new Relative();
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_PANT1));;
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_PANT2));;
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_PANT3));;
        $manager->persist($r);

        $r = new Relative();
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_PARF1));;
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_PARF2));;
        $manager->persist($r);

        $r = new Relative();
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_IRON));;
        $r->setCle1($this->getReference(ZAnnonceFixtures::ANN_BLENDER));;
        $manager->persist($r);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ZAnnonceFixtures::class,
        ];
    }
}
