<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonce>
 *
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    public function add(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Annonce[] Returns an array of Annonce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Annonce
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function getSearchId($value)
    {
        return $this->createQueryBuilder('a')
        ->where('a.id LIKE :terms')
        ->setParameter('terms', $value.'%')
        ->orderBy('a.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }  
public function getSearchTitre($value)
{
    return $this->createQueryBuilder('a')
    ->where('a.titre LIKE :terms')
    ->setParameter('terms', '%'.$value.'%')
    ->orderBy('a.titre', 'ASC')
    ->getQuery()
    ->getResult()
    ;
}    
public function getSearchDate($value)
{
    return $this->createQueryBuilder('a')
    ->where('a.createdAt LIKE :terms')
    ->setParameter('terms', '%'.$value.'%')
    ->orderBy('a.createdAt', 'ASC')
    ->getQuery()
    ->getResult()
    ;
}
public function getSearchIdIsValid($value, $isValid)
    {
        return $this->createQueryBuilder('a')
        ->andwhere('a.id LIKE :terms')
        ->andwhere('a.isValid = :val')
        ->setParameter('terms', $value.'%')
        ->setParameter('val', $isValid)
        ->orderBy('a.id', 'ASC')
        ->getQuery()
        ->getResult()
        ;
    }  
public function getSearchTitreIsValid($value, $isValid)
{
    return $this->createQueryBuilder('a')
    ->andwhere('a.titre LIKE :terms')
    ->andwhere('a.isValid = :val')
    ->setParameter('terms', '%'.$value.'%')
    ->setParameter('val', $isValid)
    ->orderBy('a.titre', 'ASC')
    ->getQuery()
    ->getResult()
    ;
}    
public function getSearchDateIsValid($value, $isValid)
{
    return $this->createQueryBuilder('a')
    ->andwhere('a.createdAt LIKE :terms')
    ->andwhere('a.isValid = :val')
    ->setParameter('terms', '%'.$value.'%')
    ->setParameter('val', $isValid)
    ->orderBy('a.createdAt', 'ASC')
    ->getQuery()
    ->getResult()
    ;
}
}
