<?php

namespace App\Tech\View;

interface ViewPoolHandlerInterface
{
    /**
     * @param string[]|string $viewName
     * @return void
     */
    public function add(mixed $viewName): void;

    /**
     * @param string[]|string $viewName
     * @return void
     */
    public function remove(mixed $viewName): void;


    public function pull(): void;
}
