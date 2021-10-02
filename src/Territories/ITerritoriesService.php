<?php

declare(strict_types=1);

namespace Northwind\Territories;

interface ITerritoriesService
{
    public function insert(TerritoriesModel $model): int;

    public function update(TerritoriesModel $model): int;

    public function get(int $territoryId): ?TerritoriesModel;

    public function getAll(): array;

    public function delete(int $territoryId): int;

    public function createModel(array $row): ?TerritoriesModel;
}