<?php

declare(strict_types=1);

namespace Northwind\OrderDetails;

interface IOrderDetailsRepository
{
    public function insert(OrderDetailsDto $dto): int;

    public function update(OrderDetailsDto $dto): int;

    public function get(int $orderDetailsId): ?OrderDetailsDto;

    public function getAll(): array;

    public function delete(int $orderDetailsId): int;
}