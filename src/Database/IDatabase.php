<?php

declare(strict_types=1);

namespace Northwind\Database;

interface IDatabase
{
    public function prepare(string $sql): IDatabaseResult;

    public function lastInsertId(): int;
}
