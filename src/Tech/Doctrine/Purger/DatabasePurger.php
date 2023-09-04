<?php

namespace App\Tech\Doctrine\Purger;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
class DatabasePurger implements DatabasePurgerInterface
{
    public const EXCLUDED = [
        'v_classement_saison',
    ];
    private ORMPurger $purger;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->purger = new ORMPurger($entityManager, self::EXCLUDED);
    }

    public function purge(): void
    {
        $this->purger->purge();
    }
}
