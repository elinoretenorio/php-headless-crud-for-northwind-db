<?php

declare(strict_types=1);

namespace Northwind\Region;

interface IRegionRepository
{
    public function insert(RegionDto $dto): int;

    public function update(RegionDto $dto): int;

    public function get(int $regionId): ?RegionDto;

    public function getAll(): array;

    public function delete(int $regionId): int;
}