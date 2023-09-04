<?php

namespace App\Tech\View;

interface MaterializedViewDescriptionInterface
{
    public function getQuery(): string;
    public function getViewTableName(): string;

    public function getUniqIndexField(): string;
}
