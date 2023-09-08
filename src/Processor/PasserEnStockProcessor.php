<?php

namespace App\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\Workflow\WorkflowInterface;

class PasserEnStockProcessor implements ProcessorInterface
{
    public function __construct(private readonly ProcessorInterface $persistProcessor, private readonly WorkflowInterface $vehiculeStateMachine)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($this->vehiculeStateMachine->can($data, 'mettre_en_stock')) {
            $this->vehiculeStateMachine->apply($data, 'mettre_en_stock');
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }


}
