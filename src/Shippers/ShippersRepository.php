<?php

declare(strict_types=1);

namespace Northwind\Shippers;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class ShippersRepository implements IShippersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ShippersDto $dto): int
    {
        $sql = "INSERT INTO `shippers` (`company_name`, `phone`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->companyName,
                $dto->phone
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ShippersDto $dto): int
    {
        $sql = "UPDATE `shippers` SET `company_name` = ?, `phone` = ?
                WHERE `shipper_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->companyName,
                $dto->phone,
                $dto->shipperId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $shipperId): ?ShippersDto
    {
        $sql = "SELECT `shipper_id`, `company_name`, `phone`
                FROM `shippers` WHERE `shipper_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$shipperId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ShippersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `shipper_id`, `company_name`, `phone`
                FROM `shippers`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ShippersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $shipperId): int
    {
        $sql = "DELETE FROM `shippers` WHERE `shipper_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$shipperId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}