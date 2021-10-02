<?php

declare(strict_types=1);

namespace Northwind\Orders;

interface IOrdersService
{
    public function insert(OrdersModel $model): int;

    public function update(OrdersModel $model): int;

    public function get(int $orderId): ?OrdersModel;

    public function getAll(): array;

    public function delete(int $orderId): int;

    public function createModel(array $row): ?OrdersModel;
}