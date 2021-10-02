<?php

declare(strict_types=1);

namespace Northwind\UsStates;

class UsStatesService implements IUsStatesService
{
    private IUsStatesRepository $repository;

    public function __construct(IUsStatesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(UsStatesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(UsStatesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $stateId): ?UsStatesModel
    {
        $dto = $this->repository->get($stateId);
        if ($dto === null) {
            return null;
        }

        return new UsStatesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var UsStatesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new UsStatesModel($dto);
        }

        return $result;
    }

    public function delete(int $stateId): int
    {
        return $this->repository->delete($stateId);
    }

    public function createModel(array $row): ?UsStatesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new UsStatesDto($row);

        return new UsStatesModel($dto);
    }
}