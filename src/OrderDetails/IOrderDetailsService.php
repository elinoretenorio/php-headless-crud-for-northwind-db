<?php

declare(strict_types=1);

namespace Northwind\OrderDetails;

interface IOrderDetailsService
{
    public function insert(OrderDetailsModel $model): int;

    public function update(OrderDetailsModel $model): int;

    public function get(int $orderDetailsId): ?OrderDetailsModel;

    public function getAll(): array;

    public function delete(int $orderDetailsId): int;

    public function createModel(array $row): ?OrderDetailsModel;
}