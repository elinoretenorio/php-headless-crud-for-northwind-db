<?php

declare(strict_types=1);

namespace Northwind\CustomerDemographics;

class CustomerDemographicsService implements ICustomerDemographicsService
{
    private ICustomerDemographicsRepository $repository;

    public function __construct(ICustomerDemographicsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CustomerDemographicsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CustomerDemographicsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $customerDemographicsId): ?CustomerDemographicsModel
    {
        $dto = $this->repository->get($customerDemographicsId);
        if ($dto === null) {
            return null;
        }

        return new CustomerDemographicsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CustomerDemographicsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CustomerDemographicsModel($dto);
        }

        return $result;
    }

    public function delete(int $customerDemographicsId): int
    {
        return $this->repository->delete($customerDemographicsId);
    }

    public function createModel(array $row): ?CustomerDemographicsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CustomerDemographicsDto($row);

        return new CustomerDemographicsModel($dto);
    }
}