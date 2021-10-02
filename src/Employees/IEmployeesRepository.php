<?php

declare(strict_types=1);

namespace Northwind\Employees;

interface IEmployeesRepository
{
    public function insert(EmployeesDto $dto): int;

    public function update(EmployeesDto $dto): int;

    public function get(int $employeeId): ?EmployeesDto;

    public function getAll(): array;

    public function delete(int $employeeId): int;
}