<?php

namespace App\Provider\ClassementSaison;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ClassementSaisonRepository;

class ClassementSaisonEquipeProvider implements ProviderInterface
{
    public function __construct(private readonly ClassementSaisonRepository $classementSaisonRepository)
    {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return $this->classementSaisonRepository->findBy(['equipe' => $uriVariables['id']],['points' => 'DESC', 'nbTop1' => 'DESC', 'nbTop4' => 'DESC']);
    }
}
