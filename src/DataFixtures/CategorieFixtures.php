<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategorieFixtures extends Fixture
{  
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const CAT_MODE = "pantalon";
    public const CAT_BEAUTY = "cat-beauty";
    public const CAT_ELECTRO = "elactro";

    public function load(ObjectManager $manager): void
    {
        $cat = new Categorie();
        $cat -> setTitre('mode');
        $cat -> setImageName('mode.png');
        $cat -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($cat);
        $this->addReference(self::CAT_MODE, $cat);

        $cat = new Categorie();
        $cat -> setTitre('beauty');
        $cat -> setImageName('beauty.png');
        $cat -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($cat);
        $this->addReference(self::CAT_BEAUTY, $cat);

        $cat = new Categorie();
        $cat -> setTitre('electromenager');
        $cat -> setImageName('electro.png');
        $cat -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($cat);
        $this->addReference(self::CAT_ELECTRO, $cat);

        $manager->flush();
    }
}
