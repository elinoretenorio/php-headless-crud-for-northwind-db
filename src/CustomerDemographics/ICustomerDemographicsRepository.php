<?php

declare(strict_types=1);

namespace Northwind\CustomerDemographics;

interface ICustomerDemographicsRepository
{
    public function insert(CustomerDemographicsDto $dto): int;

    public function update(CustomerDemographicsDto $dto): int;

    public function get(int $customerDemographicsId): ?CustomerDemographicsDto;

    public function getAll(): array;

    public function delete(int $customerDemographicsId): int;
}