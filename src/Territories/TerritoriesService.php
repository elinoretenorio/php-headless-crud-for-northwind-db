<?php

declare(strict_types=1);

namespace Northwind\Territories;

class TerritoriesService implements ITerritoriesService
{
    private ITerritoriesRepository $repository;

    public function __construct(ITerritoriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(TerritoriesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(TerritoriesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $territoryId): ?TerritoriesModel
    {
        $dto = $this->repository->get($territoryId);
        if ($dto === null) {
            return null;
        }

        return new TerritoriesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var TerritoriesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new TerritoriesModel($dto);
        }

        return $result;
    }

    public function delete(int $territoryId): int
    {
        return $this->repository->delete($territoryId);
    }

    public function createModel(array $row): ?TerritoriesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new TerritoriesDto($row);

        return new TerritoriesModel($dto);
    }
}