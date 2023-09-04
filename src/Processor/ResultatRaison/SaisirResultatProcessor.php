<?php

namespace App\Processor\ResultatRaison;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\ResultatPartie;

class SaisirResultatProcessor implements ProcessorInterface
{
    public function __construct()
    {
    }

    /**
     * @param ResultatPartie $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $place = $data->getPlace();
        $points = range(8,1, -1);
        $data->setPoints($points[$place-1]);

        return $data;
    }
}
