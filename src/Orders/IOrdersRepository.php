<?php

declare(strict_types=1);

namespace Northwind\Orders;

interface IOrdersRepository
{
    public function insert(OrdersDto $dto): int;

    public function update(OrdersDto $dto): int;

    public function get(int $orderId): ?OrdersDto;

    public function getAll(): array;

    public function delete(int $orderId): int;
}