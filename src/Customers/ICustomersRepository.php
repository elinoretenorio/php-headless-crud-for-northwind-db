<?php

declare(strict_types=1);

namespace Northwind\Customers;

interface ICustomersRepository
{
    public function insert(CustomersDto $dto): int;

    public function update(CustomersDto $dto): int;

    public function get(int $customerId): ?CustomersDto;

    public function getAll(): array;

    public function delete(int $customerId): int;
}