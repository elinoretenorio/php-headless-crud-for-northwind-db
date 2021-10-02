<?php

declare(strict_types=1);

namespace Northwind\Products;

interface IProductsService
{
    public function insert(ProductsModel $model): int;

    public function update(ProductsModel $model): int;

    public function get(int $productId): ?ProductsModel;

    public function getAll(): array;

    public function delete(int $productId): int;

    public function createModel(array $row): ?ProductsModel;
}