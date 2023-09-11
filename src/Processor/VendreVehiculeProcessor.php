<?php

namespace App\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\Workflow\WorkflowInterface;

class VendreVehiculeProcessor implements ProcessorInterface
{
    public function __construct(private readonly ProcessorInterface $persistProcessor, private readonly WorkflowInterface $vehiculeStateMachine)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($this->vehiculeStateMachine->can($data, 'vendre')) {
            $this->vehiculeStateMachine->apply($data, 'vendre');
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }


}
