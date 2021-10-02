<?php

declare(strict_types=1);

namespace Northwind\CustomerDemo;

class CustomerDemoService implements ICustomerDemoService
{
    private ICustomerDemoRepository $repository;

    public function __construct(ICustomerDemoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CustomerDemoModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CustomerDemoModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $customerDemoId): ?CustomerDemoModel
    {
        $dto = $this->repository->get($customerDemoId);
        if ($dto === null) {
            return null;
        }

        return new CustomerDemoModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CustomerDemoDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CustomerDemoModel($dto);
        }

        return $result;
    }

    public function delete(int $customerDemoId): int
    {
        return $this->repository->delete($customerDemoId);
    }

    public function createModel(array $row): ?CustomerDemoModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CustomerDemoDto($row);

        return new CustomerDemoModel($dto);
    }
}