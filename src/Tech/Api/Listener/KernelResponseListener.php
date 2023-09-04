<?php

namespace App\Tech\Api\Listener;

use ApiPlatform\Metadata\Operation;
use App\Tech\View\Messenger\UpdateViewEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsEventListener(event: KernelEvents::RESPONSE, method: 'onKernelView')]
class KernelResponseListener
{
    public const VIEW_UPDATE_LIST = 'view_update_list';

    public function __construct(private readonly MessageBusInterface $bus)
    {
    }


    public function onKernelView(ResponseEvent $event): void
    {
        $request = $event->getRequest();
        $operation = $request->attributes->get('_api_operation');

        if ($operation instanceof Operation) {
            $extraProperties = $operation->getExtraProperties();
            if (isset($extraProperties[self::VIEW_UPDATE_LIST])) {
                foreach ($extraProperties[self::VIEW_UPDATE_LIST] as $viewName) {
                    $this->bus->dispatch(new UpdateViewEvent($viewName));
                }
            }
        }
    }
}
