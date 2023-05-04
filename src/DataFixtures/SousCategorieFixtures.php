<?php

namespace App\DataFixtures;

use App\Entity\SousCategorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SousCategorieFixtures extends Fixture
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const SOUS_1 = "Vetments";
    public const SOUS_2 = "accessoire";
    public const SOUS_3 = "parfums";
    public const SOUS_4 = "Beauté";

    public function load(ObjectManager $manager): void
    {
        $sous = new SousCategorie();
        $sous -> setTitre('Vetments');
        $manager->persist($sous);
        $this->addReference(self::SOUS_1, $sous);
        $sous->setCategorie($this->getReference(CategorieFixtures::CAT_MODE));

        $sous = new SousCategorie();
        $sous -> setTitre('accessoire');
        $manager->persist($sous);
        $this->addReference(self::SOUS_2, $sous);
        $sous->setCategorie($this->getReference(CategorieFixtures::CAT_MODE));

        $sous = new SousCategorie();
        $sous -> setTitre('parfums');
        $manager->persist($sous);
        $this->addReference(self::SOUS_3, $sous);
        $sous->setCategorie($this->getReference(CategorieFixtures::CAT_BEAUTY));

        $sous = new SousCategorie();
        $sous -> setTitre('Beauté');
        $manager->persist($sous);
        $this->addReference(self::SOUS_4, $sous);
        $sous->setCategorie($this->getReference(CategorieFixtures::CAT_BEAUTY));

        $manager->flush();
    }
    // public function getDependencies()
    // {
    //     return [
    //         ZAnnonceFixtures::class,
    //     ];
    // }
}
