<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

class EmployeeTerritoriesService implements IEmployeeTerritoriesService
{
    private IEmployeeTerritoriesRepository $repository;

    public function __construct(IEmployeeTerritoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(EmployeeTerritoriesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(EmployeeTerritoriesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $employeeTerritoriesId): ?EmployeeTerritoriesModel
    {
        $dto = $this->repository->get($employeeTerritoriesId);
        if ($dto === null) {
            return null;
        }

        return new EmployeeTerritoriesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var EmployeeTerritoriesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new EmployeeTerritoriesModel($dto);
        }

        return $result;
    }

    public function delete(int $employeeTerritoriesId): int
    {
        return $this->repository->delete($employeeTerritoriesId);
    }

    public function createModel(array $row): ?EmployeeTerritoriesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new EmployeeTerritoriesDto($row);

        return new EmployeeTerritoriesModel($dto);
    }
}