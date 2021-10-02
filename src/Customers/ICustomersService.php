<?php

declare(strict_types=1);

namespace Northwind\Customers;

interface ICustomersService
{
    public function insert(CustomersModel $model): int;

    public function update(CustomersModel $model): int;

    public function get(int $customerId): ?CustomersModel;

    public function getAll(): array;

    public function delete(int $customerId): int;

    public function createModel(array $row): ?CustomersModel;
}