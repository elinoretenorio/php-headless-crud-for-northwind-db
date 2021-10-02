<?php

declare(strict_types=1);

namespace Northwind\CustomerDemo;

interface ICustomerDemoService
{
    public function insert(CustomerDemoModel $model): int;

    public function update(CustomerDemoModel $model): int;

    public function get(int $customerDemoId): ?CustomerDemoModel;

    public function getAll(): array;

    public function delete(int $customerDemoId): int;

    public function createModel(array $row): ?CustomerDemoModel;
}