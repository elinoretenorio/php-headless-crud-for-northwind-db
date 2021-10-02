<?php

declare(strict_types=1);

namespace Northwind\CustomerDemographics;

interface ICustomerDemographicsService
{
    public function insert(CustomerDemographicsModel $model): int;

    public function update(CustomerDemographicsModel $model): int;

    public function get(int $customerDemographicsId): ?CustomerDemographicsModel;

    public function getAll(): array;

    public function delete(int $customerDemographicsId): int;

    public function createModel(array $row): ?CustomerDemographicsModel;
}