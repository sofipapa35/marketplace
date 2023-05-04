<?php

namespace App\DataFixtures;

use DateTimeImmutable;
use App\Entity\Annonce;
use App\DataFixtures\CategorieFixtures;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\SousCategorieFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ZAnnonceFixtures extends Fixture implements DependentFixtureInterface
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const ANN_PANT1 = "pantalon1";
    public const ANN_PANT2 = "pantalon2";
    public const ANN_PANT3 = "pantalon3";
    public const ANN_BLENDER = "blender";
    public const ANN_BEAUTY = "beauty";
    public const ANN_IRON = "iron";
    public const ANN_HAT = "hat";
    public const ANN_PARF1 = "parfum1";
    public const ANN_PARF2 = "parfum2";
  
    public function load(ObjectManager $manager): void
    {
        $ann = new Annonce();
        $ann -> setTitre('Pantalon');
        $ann -> setImageName('pants1.png');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(20);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setSexe('m');
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-18"));
        $manager->persist($ann);
        $this->addReference(self::ANN_PANT1, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_MODE));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_1));

        $ann = new Annonce();
        $ann -> setTitre('Pantalon bleu');
        $ann -> setImageName('pants2.png');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(15.90);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setSexe('m');
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-19"));
        $manager->persist($ann);
        $this->addReference(self::ANN_PANT2, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_MODE));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_1));

        $ann = new Annonce();
        $ann -> setTitre('Pantalon orange');
        $ann -> setImageName('pants3.png');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(14.50);
        $ann -> setIsValid(true);
        $ann -> setSexe('m');
        $ann -> setIsActive(true);
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-18"));
        $manager->persist($ann);
        $this->addReference(self::ANN_PANT3, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_MODE));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_1));

        $ann = new Annonce();
        $ann -> setTitre('Blender');
        $ann -> setImageName('blender.jpg');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(30);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-20"));
        $manager->persist($ann);
        $this->addReference(self::ANN_BLENDER, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_ELECTRO));

        $ann = new Annonce();
        $ann -> setTitre('beauty');
        $ann -> setImageName('eye.png');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(10.50);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-18"));
        $manager->persist($ann);
        $this->addReference(self::ANN_BEAUTY, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_BEAUTY));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_4));

        $ann = new Annonce();
        $ann -> setTitre('chapeau');
        $ann -> setImageName('hat.jpg');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(10);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setSexe('f');
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-17"));
        $manager->persist($ann);
        $this->addReference(self::ANN_HAT, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_MODE));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_2));

        $ann = new Annonce();
        $ann -> setTitre('Iron');
        $ann -> setImageName('iron.jpg');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(19.90);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-18"));
        $manager->persist($ann);
        $this->addReference(self::ANN_IRON, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_ELECTRO));

        $ann = new Annonce();
        $ann -> setTitre('parfum');
        $ann -> setImageName('parfum1.png');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(17.50);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setSexe('f');
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-20"));
        $manager->persist($ann);
        $this->addReference(self::ANN_PARF1, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_BEAUTY));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_3));

        $ann = new Annonce();
        $ann -> setTitre('parfum femme');
        $ann -> setImageName('parfum2.png');
        $ann -> setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin facilisis nisl sit amet nulla mattis vestibulum. Fusce consectetur dignissim dolor. Morbi condimentum, ante nec venenatis dignissim, ante urna aliquet orci, vel varius augue dolor eu nisl. Sed nec porttitor augue, id blandit elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae');
        $ann -> setPrix(16);
        $ann -> setIsValid(true);
        $ann -> setIsActive(true);
        $ann -> setSexe('f');
        $ann -> setUpdatedAt(new DateTimeImmutable);
        $ann -> setCreatedAt(new DateTimeImmutable("2023-04-18"));
        $manager->persist($ann);
        $this->addReference(self::ANN_PARF2, $ann);
        $ann->setCategorie($this->getReference(CategorieFixtures::CAT_BEAUTY));
        $ann->setSousCategorie($this->getReference(SousCategorieFixtures::SOUS_3));

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategorieFixtures::class,
        ];
    }
}
