<?php

namespace App\Repository;

use App\Entity\SuiviCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SuiviCommande>
 *
 * @method SuiviCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuiviCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuiviCommande[]    findAll()
 * @method SuiviCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuiviCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuiviCommande::class);
    }

//    /**
//     * @return SuiviCommande[] Returns an array of SuiviCommande objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SuiviCommande
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
