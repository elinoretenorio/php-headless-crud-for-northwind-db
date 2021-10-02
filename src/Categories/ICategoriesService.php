<?php

declare(strict_types=1);

namespace Northwind\Categories;

interface ICategoriesService
{
    public function insert(CategoriesModel $model): int;

    public function update(CategoriesModel $model): int;

    public function get(int $categoryId): ?CategoriesModel;

    public function getAll(): array;

    public function delete(int $categoryId): int;

    public function createModel(array $row): ?CategoriesModel;
}