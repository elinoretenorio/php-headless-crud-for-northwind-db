<?php

declare(strict_types=1);

namespace Northwind\Products;

class ProductsService implements IProductsService
{
    private IProductsRepository $repository;

    public function __construct(IProductsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ProductsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ProductsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $productId): ?ProductsModel
    {
        $dto = $this->repository->get($productId);
        if ($dto === null) {
            return null;
        }

        return new ProductsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ProductsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ProductsModel($dto);
        }

        return $result;
    }

    public function delete(int $productId): int
    {
        return $this->repository->delete($productId);
    }

    public function createModel(array $row): ?ProductsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ProductsDto($row);

        return new ProductsModel($dto);
    }
}