<?php

declare(strict_types=1);

namespace Northwind\Territories;

interface ITerritoriesRepository
{
    public function insert(TerritoriesDto $dto): int;

    public function update(TerritoriesDto $dto): int;

    public function get(int $territoryId): ?TerritoriesDto;

    public function getAll(): array;

    public function delete(int $territoryId): int;
}