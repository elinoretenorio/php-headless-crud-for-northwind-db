<?php

declare(strict_types=1);

namespace Northwind\Suppliers;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class SuppliersRepository implements ISuppliersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(SuppliersDto $dto): int
    {
        $sql = "INSERT INTO `suppliers` (`company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`, `homepage`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->companyName,
                $dto->contactName,
                $dto->contactTitle,
                $dto->address,
                $dto->city,
                $dto->region,
                $dto->postalCode,
                $dto->country,
                $dto->phone,
                $dto->fax,
                $dto->homepage
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(SuppliersDto $dto): int
    {
        $sql = "UPDATE `suppliers` SET `company_name` = ?, `contact_name` = ?, `contact_title` = ?, `address` = ?, `city` = ?, `region` = ?, `postal_code` = ?, `country` = ?, `phone` = ?, `fax` = ?, `homepage` = ?
                WHERE `supplier_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->companyName,
                $dto->contactName,
                $dto->contactTitle,
                $dto->address,
                $dto->city,
                $dto->region,
                $dto->postalCode,
                $dto->country,
                $dto->phone,
                $dto->fax,
                $dto->homepage,
                $dto->supplierId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $supplierId): ?SuppliersDto
    {
        $sql = "SELECT `supplier_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`, `homepage`
                FROM `suppliers` WHERE `supplier_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$supplierId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new SuppliersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `supplier_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`, `homepage`
                FROM `suppliers`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new SuppliersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $supplierId): int
    {
        $sql = "DELETE FROM `suppliers` WHERE `supplier_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$supplierId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}