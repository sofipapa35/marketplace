<?php


namespace App\DataFixtures;


use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AdresseFixtures extends Fixture
{
  // ====================================================== //
  // ===================== PROPRIETES ===================== //
  // ====================================================== //
  public const AD1 = "ad1";
  public const AD2 = "ad2";
  public const AD3 = "ad3";
  public const AD4 = "ad4";


  public function load(ObjectManager $manager): void
  {
    $adresse = new Adresse();
    $adresse -> setAdresse('1 rue de soleil');
    $adresse -> setZip('77777');
    $adresse -> setVille('Paris');
    $manager->persist($adresse);
    $this->addReference(self::AD1, $adresse);


    $adresse = new Adresse();
    $adresse -> setAdresse('17 rue de soleil');
    $adresse -> setZip('222211');
    $adresse -> setVille('Lyon');
    $manager->persist($adresse);
    $this->addReference(self::AD2, $adresse);
    
    $adresse = new Adresse();
    $adresse -> setAdresse('20 rue de soleil');
    $adresse -> setZip('45223');
    $adresse -> setVille('Paris');
    $manager->persist($adresse);
    $this->addReference(self::AD3, $adresse);
    
    $adresse = new Adresse();
    $adresse -> setAdresse('2 rue de soleil');
    $adresse -> setZip('77711');
    $adresse -> setVille('Paris');
    $manager->persist($adresse);
    $this->addReference(self::AD4, $adresse);


    $manager->flush();
  }
}


