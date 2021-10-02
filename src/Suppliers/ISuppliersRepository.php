<?php

declare(strict_types=1);

namespace Northwind\Suppliers;

interface ISuppliersRepository
{
    public function insert(SuppliersDto $dto): int;

    public function update(SuppliersDto $dto): int;

    public function get(int $supplierId): ?SuppliersDto;

    public function getAll(): array;

    public function delete(int $supplierId): int;
}