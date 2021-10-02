<?php

declare(strict_types=1);

namespace Northwind\Region;

class RegionService implements IRegionService
{
    private IRegionRepository $repository;

    public function __construct(IRegionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(RegionModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(RegionModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $regionId): ?RegionModel
    {
        $dto = $this->repository->get($regionId);
        if ($dto === null) {
            return null;
        }

        return new RegionModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var RegionDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new RegionModel($dto);
        }

        return $result;
    }

    public function delete(int $regionId): int
    {
        return $this->repository->delete($regionId);
    }

    public function createModel(array $row): ?RegionModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new RegionDto($row);

        return new RegionModel($dto);
    }
}