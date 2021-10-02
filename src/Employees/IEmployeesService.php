<?php

declare(strict_types=1);

namespace Northwind\Employees;

interface IEmployeesService
{
    public function insert(EmployeesModel $model): int;

    public function update(EmployeesModel $model): int;

    public function get(int $employeeId): ?EmployeesModel;

    public function getAll(): array;

    public function delete(int $employeeId): int;

    public function createModel(array $row): ?EmployeesModel;
}