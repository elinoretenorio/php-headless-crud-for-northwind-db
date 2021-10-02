<?php

declare(strict_types=1);

namespace Northwind\Shippers;

interface IShippersRepository
{
    public function insert(ShippersDto $dto): int;

    public function update(ShippersDto $dto): int;

    public function get(int $shipperId): ?ShippersDto;

    public function getAll(): array;

    public function delete(int $shipperId): int;
}