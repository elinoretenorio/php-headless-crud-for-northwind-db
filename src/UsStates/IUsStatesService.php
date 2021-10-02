<?php

declare(strict_types=1);

namespace Northwind\UsStates;

interface IUsStatesService
{
    public function insert(UsStatesModel $model): int;

    public function update(UsStatesModel $model): int;

    public function get(int $stateId): ?UsStatesModel;

    public function getAll(): array;

    public function delete(int $stateId): int;

    public function createModel(array $row): ?UsStatesModel;
}