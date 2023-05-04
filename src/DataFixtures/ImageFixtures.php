<?php

namespace App\DataFixtures;

use App\Entity\Image;
use DateTimeImmutable;
use App\DataFixtures\ZAnnonceFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface

{
    public function load(ObjectManager $manager): void
    {
        $img = new Image();
        $img -> setTitre('blender.jpg');
        $img -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($img);
        $img->setAnnonce($this->getReference(ZAnnonceFixtures::ANN_BLENDER));

        $img = new Image();
        $img -> setTitre('eye.png');
        $img -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($img);
        $img->setAnnonce($this->getReference(ZAnnonceFixtures::ANN_BEAUTY));

        $img = new Image();
        $img -> setTitre('hat.jpg');
        $img -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($img);
        $img->setAnnonce($this->getReference(ZAnnonceFixtures::ANN_HAT));

        $img = new Image();
        $img -> setTitre('iron.jpg');
        $img -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($img);
        $img->setAnnonce($this->getReference(ZAnnonceFixtures::ANN_IRON));

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ZAnnonceFixtures::class,
        ];
    }
}
