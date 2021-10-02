<?php

declare(strict_types=1);

namespace Northwind\Orders;

class OrdersService implements IOrdersService
{
    private IOrdersRepository $repository;

    public function __construct(IOrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(OrdersModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(OrdersModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $orderId): ?OrdersModel
    {
        $dto = $this->repository->get($orderId);
        if ($dto === null) {
            return null;
        }

        return new OrdersModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var OrdersDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new OrdersModel($dto);
        }

        return $result;
    }

    public function delete(int $orderId): int
    {
        return $this->repository->delete($orderId);
    }

    public function createModel(array $row): ?OrdersModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new OrdersDto($row);

        return new OrdersModel($dto);
    }
}