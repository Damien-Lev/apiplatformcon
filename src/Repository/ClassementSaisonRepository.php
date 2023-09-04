<?php

namespace App\Repository;
use App\ApiResource\View\ClassementSaison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassementSaison>
 *
 * @method ClassementSaison|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassementSaison|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassementSaison[]    findAll()
 * @method ClassementSaison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassementSaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassementSaison::class);
    }
}
