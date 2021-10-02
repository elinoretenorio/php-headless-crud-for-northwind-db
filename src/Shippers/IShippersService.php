<?php

declare(strict_types=1);

namespace Northwind\Shippers;

interface IShippersService
{
    public function insert(ShippersModel $model): int;

    public function update(ShippersModel $model): int;

    public function get(int $shipperId): ?ShippersModel;

    public function getAll(): array;

    public function delete(int $shipperId): int;

    public function createModel(array $row): ?ShippersModel;
}