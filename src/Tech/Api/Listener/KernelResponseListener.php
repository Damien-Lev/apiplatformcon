<?php

namespace App\Tech\Api\Listener;

use ApiPlatform\Metadata\Operation;
use App\Tech\View\Messenger\UpdateViewEvent;
use App\Tech\View\ViewPoolHandlerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEventListener(event: KernelEvents::RESPONSE, method: 'onKernelView')]
class KernelResponseListener
{
    public function __construct(private readonly ViewPoolHandlerInterface $viewPoolHandler)
    {
    }

    public function onKernelView(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $operation = $request->attributes->get('_api_operation');

        if ($operation instanceof Operation) {
            $this->viewPoolHandler->pull();
        }
    }
}
