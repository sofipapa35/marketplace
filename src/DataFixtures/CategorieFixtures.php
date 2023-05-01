<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SousCategorieFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategorieFixtures extends Fixture implements DependentFixtureInterface
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
        $cat->addSousCategory($this->getReference(SousCategorieFixtures::SOUS_1));
        $cat->addSousCategory($this->getReference(SousCategorieFixtures::SOUS_2));

        $cat = new Categorie();
        $cat -> setTitre('beauty');
        $cat -> setImageName('beauty.png');
        $cat -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($cat);
        $this->addReference(self::CAT_BEAUTY, $cat);
        $cat->addSousCategory($this->getReference(SousCategorieFixtures::SOUS_3));
        $cat->addSousCategory($this->getReference(SousCategorieFixtures::SOUS_4));

        $cat = new Categorie();
        $cat -> setTitre('electromenager');
        $cat -> setImageName('electro.png');
        $cat -> setUpdatedAt(new DateTimeImmutable);
        $manager->persist($cat);
        $this->addReference(self::CAT_ELECTRO, $cat);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            SousCategorieFixtures::class,
        ];
    }
}
