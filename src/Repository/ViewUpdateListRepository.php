<?php

namespace App\Repository;

use App\Entity\ViewUpdateList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ViewUpdateList>
 *
 * @method ViewUpdateList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ViewUpdateList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ViewUpdateList[]    findAll()
 * @method ViewUpdateList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViewUpdateListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ViewUpdateList::class);
    }

//    /**
//     * @return ViewUpdateList[] Returns an array of ViewUpdateList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ViewUpdateList
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
