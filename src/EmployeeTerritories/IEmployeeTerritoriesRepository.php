<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

interface IEmployeeTerritoriesRepository
{
    public function insert(EmployeeTerritoriesDto $dto): int;

    public function update(EmployeeTerritoriesDto $dto): int;

    public function get(int $employeeTerritoriesId): ?EmployeeTerritoriesDto;

    public function getAll(): array;

    public function delete(int $employeeTerritoriesId): int;
}