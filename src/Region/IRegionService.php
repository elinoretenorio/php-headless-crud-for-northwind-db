<?php

declare(strict_types=1);

namespace Northwind\Region;

interface IRegionService
{
    public function insert(RegionModel $model): int;

    public function update(RegionModel $model): int;

    public function get(int $regionId): ?RegionModel;

    public function getAll(): array;

    public function delete(int $regionId): int;

    public function createModel(array $row): ?RegionModel;
}