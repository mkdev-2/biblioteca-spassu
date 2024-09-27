<?php

namespace App\Repositories;

interface RelatorioRepositoryInterface
{
    public function createViews();
    public function dropViews();
    public function getLivrosByType(string $tipo);
}
