<?php

namespace App\Tech\View;

use App\Entity\ViewUpdateList;
use App\Repository\ViewUpdateListRepository;
use App\Tech\View\Messenger\UpdateViewEvent;
use Doctrine\ORM\EntityManagerInterface;
use http\Message;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Messenger\MessageBusInterface;

class ViewPoolHandler implements ViewPoolHandlerInterface
{
    /**
     * @var string[]
     */
    private array $viewNames = [];

    public function __construct(private readonly ViewUpdateListRepository $viewUpdateListRepository,private readonly MessageBusInterface $bus, private readonly EntityManagerInterface $entityManager)
    {
    }

    public function add(mixed $viewName): void
    {
        if (is_array($viewName)) {
            $this->viewNames = array_values(array_unique(array_merge($this->viewNames, $viewName)));
            return;
        }
        $this->add([$viewName]);
    }

    public function remove(mixed $viewName): void
    {
        if (is_array($viewName)) {
            $this->viewNames = array_values(array_diff($this->viewNames, $viewName));
            return;
        }
        $this->remove([$viewName]);
    }

    public function pull(): void
    {
        foreach ($this->viewNames as $viewName) {
            if (!$this->viewUpdateListRepository->findOneBy(['viewName' => $viewName])) {
                $viewUpdateList = (new ViewUpdateList())->setViewName($viewName);
                $this->entityManager->persist($viewUpdateList);
                $this->entityManager->flush();
                $event = new UpdateViewEvent($viewName);
                $this->bus->dispatch($event);
            }
        }
    }
}
