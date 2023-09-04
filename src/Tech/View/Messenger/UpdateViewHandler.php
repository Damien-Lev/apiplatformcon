<?php

namespace App\Tech\View\Messenger;

use App\Entity\ViewUpdateList;
use App\Repository\ViewUpdateListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UpdateViewHandler
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function __invoke(UpdateViewEvent $message): void
    {
       $this
           ->entityManager
           ->getRepository(ViewUpdateList::class)
           ->createQueryBuilder('v')
           ->delete()
           ->where('v.viewName = :view_name')
           ->setParameter('view_name', $message->getViewName())
           ->getQuery()
           ->getResult();
       $this->entityManager->getConnection()->executeStatement(sprintf('REFRESH MATERIALIZED VIEW CONCURRENTLY %s WITH DATA;', $message->getViewName()));
    }
}
