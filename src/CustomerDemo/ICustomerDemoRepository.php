<?php

declare(strict_types=1);

namespace Northwind\CustomerDemo;

interface ICustomerDemoRepository
{
    public function insert(CustomerDemoDto $dto): int;

    public function update(CustomerDemoDto $dto): int;

    public function get(int $customerDemoId): ?CustomerDemoDto;

    public function getAll(): array;

    public function delete(int $customerDemoId): int;
}