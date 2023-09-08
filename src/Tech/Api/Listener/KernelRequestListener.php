<?php

namespace App\Tech\Api\Listener;

use ApiPlatform\Metadata\Operation;
use App\Tech\View\ViewPoolHandlerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::REQUEST, method: 'onKernelRequest')]
class KernelRequestListener
{
    public const VIEW_UPDATE_LIST = 'view_update_list';

    public function __construct(private readonly ViewPoolHandlerInterface $viewPoolHandler)
    {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $operation = $request->attributes->get('_api_operation');

        if ($operation instanceof Operation) {
            $extraProperties = $operation->getExtraProperties();
            if (isset($extraProperties[self::VIEW_UPDATE_LIST])) {
                $this->viewPoolHandler->add($extraProperties[self::VIEW_UPDATE_LIST]);
            }
        }
    }
}
