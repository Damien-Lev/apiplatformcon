<?php

namespace App\Repository;

use App\Entity\HistoriquePropriete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoriquePropriete>
 *
 * @method HistoriquePropriete|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriquePropriete|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriquePropriete[]    findAll()
 * @method HistoriquePropriete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueProprieteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriquePropriete::class);
    }

//    /**
//     * @return HistoriquePropriete[] Returns an array of HistoriquePropriete objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HistoriquePropriete
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
