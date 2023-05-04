<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SousCategorieFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategorieFixtures extends Fixture
{  
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const CAT_MODE = "mode";
    public const CAT_BEAUTY = "cat-beauty";
    public const CAT_ELECTRO = "electro";

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
