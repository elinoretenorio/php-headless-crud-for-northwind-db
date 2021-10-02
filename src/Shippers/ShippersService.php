<?php

declare(strict_types=1);

namespace Northwind\Shippers;

class ShippersService implements IShippersService
{
    private IShippersRepository $repository;

    public function __construct(IShippersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ShippersModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ShippersModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $shipperId): ?ShippersModel
    {
        $dto = $this->repository->get($shipperId);
        if ($dto === null) {
            return null;
        }

        return new ShippersModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ShippersDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ShippersModel($dto);
        }

        return $result;
    }

    public function delete(int $shipperId): int
    {
        return $this->repository->delete($shipperId);
    }

    public function createModel(array $row): ?ShippersModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ShippersDto($row);

        return new ShippersModel($dto);
    }
}