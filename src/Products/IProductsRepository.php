<?php

declare(strict_types=1);

namespace Northwind\Products;

interface IProductsRepository
{
    public function insert(ProductsDto $dto): int;

    public function update(ProductsDto $dto): int;

    public function get(int $productId): ?ProductsDto;

    public function getAll(): array;

    public function delete(int $productId): int;
}