<?php

namespace App\Tech\Doctrine\Purger;

interface DatabasePurgerInterface
{
    public function purge(): void;
}
