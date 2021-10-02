<?php

declare(strict_types=1);

namespace Northwind\UsStates;

interface IUsStatesRepository
{
    public function insert(UsStatesDto $dto): int;

    public function update(UsStatesDto $dto): int;

    public function get(int $stateId): ?UsStatesDto;

    public function getAll(): array;

    public function delete(int $stateId): int;
}