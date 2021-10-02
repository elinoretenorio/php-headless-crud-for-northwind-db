<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

interface IEmployeeTerritoriesService
{
    public function insert(EmployeeTerritoriesModel $model): int;

    public function update(EmployeeTerritoriesModel $model): int;

    public function get(int $employeeTerritoriesId): ?EmployeeTerritoriesModel;

    public function getAll(): array;

    public function delete(int $employeeTerritoriesId): int;

    public function createModel(array $row): ?EmployeeTerritoriesModel;
}