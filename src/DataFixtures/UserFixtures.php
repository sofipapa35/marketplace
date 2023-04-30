<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    //
    // ====================================================== //
    // ==================== CONSTRUCTEUR ==================== //
    // ====================================================== //
    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->encoder = $userPasswordHasherInterface;
    }
    // ====================================================== //
    // ====================== METHODES ====================== //
    // ====================================================== //
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user -> setNom('admin');
        $user -> setPrenom('admin');
        $user -> setEmail('admin@admin.com');
        $password = $this->encoder->hashPassword($user, "soleilsoleil");
        $user->setPassword($password);
        $user -> isVerified(false);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user -> setTelephone('00330711111111');
        $manager->persist($user);
        $user->addAdresse($this->getReference(AdresseFixtures::AD1));

        $user = new User();
        $user -> setNom('papa');
        $user -> setPrenom('sofi');
        $user -> setEmail('sofi@test.com');
        $password = $this->encoder->hashPassword($user, "soleilsoleil");
        $user->setPassword($password);
        $user -> isVerified(false);
        $user->setRoles(['ROLE_USER']);
        $user -> setTelephone('00330711111111');
        $manager->persist($user);
        $user->addAdresse($this->getReference(AdresseFixtures::AD2));
        $user->addAdresse($this->getReference(AdresseFixtures::AD3));

        $user = new User();
        $user -> setNom('test');
        $user -> setPrenom('jean');
        $user -> setEmail('jean@test.com');
        $password = $this->encoder->hashPassword($user, "soleilsoleil");
        $user->setPassword($password);
        $user -> isVerified(false);
        $user->setRoles(['ROLE_USER']);
        $user -> setPseudo('J');
        $manager->persist($user);
        $user->addAdresse($this->getReference(AdresseFixtures::AD4));

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            AdresseFixtures::class,
        ];
    }
}
