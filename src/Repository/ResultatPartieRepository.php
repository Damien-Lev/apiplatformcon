<?php

namespace App\Repository;

use App\Entity\ResultatPartie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResultatPartie>
 *
 * @method ResultatPartie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultatPartie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultatPartie[]    findAll()
 * @method ResultatPartie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultatPartieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResultatPartie::class);
    }

//    /**
//     * @return ResultatPartie[] Returns an array of ResultatPartie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResultatPartie
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
