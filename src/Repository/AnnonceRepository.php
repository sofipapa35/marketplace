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
//    public function getRelatives1($annId): ?Annonce
//    {
//         return $this->createQueryBuilder('a')
//         ->join('a.relatives1', 'r1')
//         ->andWhere('r1.cle1 = :val1')
//            ->setParameter('val1', $annId)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }   
//    public function getRelatives2($annId): ?Annonce
//    {
//         return $this->createQueryBuilder('a')
//         ->join('a.relatives2', 'r2')
//         ->orWhere('r2.cle2 = :val2')
//            ->setParameter('val2', $annId)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
   
//  public function getArticlesHome($category_id, $locale): array
//  {
//      return $this->createQueryBuilder('a')
//             ->join('a.article', 'ar')
//             ->join('ar.category', 'c')
//          ->andWhere('c.id = :val2')
//          ->andWhere('ar.active = :val3')
//          ->andWhere('a.lang = :val4')
//          ->setParameter('val2', $category_id)
//          ->setParameter('val3', true)
//          ->setParameter('val4', $locale)
//       //    ->orderBy('a.id', 'ASC')
//       //    ->setMaxResults(10)
//          ->getQuery()
//          ->getResult()
//      ;
//  }
}
