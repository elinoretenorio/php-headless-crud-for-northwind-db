<?php

declare(strict_types=1);

namespace Northwind\Suppliers;

interface ISuppliersService
{
    public function insert(SuppliersModel $model): int;

    public function update(SuppliersModel $model): int;

    public function get(int $supplierId): ?SuppliersModel;

    public function getAll(): array;

    public function delete(int $supplierId): int;

    public function createModel(array $row): ?SuppliersModel;
}