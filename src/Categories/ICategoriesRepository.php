<?php

declare(strict_types=1);

namespace Northwind\Categories;

interface ICategoriesRepository
{
    public function insert(CategoriesDto $dto): int;

    public function update(CategoriesDto $dto): int;

    public function get(int $categoryId): ?CategoriesDto;

    public function getAll(): array;

    public function delete(int $categoryId): int;
}