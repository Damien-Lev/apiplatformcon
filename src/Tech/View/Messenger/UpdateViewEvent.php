<?php

namespace App\Tech\View\Messenger;

class UpdateViewEvent
{
    public function __construct(private readonly string $viewName)
    {
    }

    public function getViewName(): string
    {
        return $this->viewName;
    }
}
