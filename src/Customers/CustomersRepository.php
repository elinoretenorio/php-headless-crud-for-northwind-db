<?php

declare(strict_types=1);

namespace Northwind\Customers;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class CustomersRepository implements ICustomersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomersDto $dto): int
    {
        $sql = "INSERT INTO `customers` (`company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
                $dto->fax
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomersDto $dto): int
    {
        $sql = "UPDATE `customers` SET `company_name` = ?, `contact_name` = ?, `contact_title` = ?, `address` = ?, `city` = ?, `region` = ?, `postal_code` = ?, `country` = ?, `phone` = ?, `fax` = ?
                WHERE `customer_id` = ?";

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
                $dto->customerId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customerId): ?CustomersDto
    {
        $sql = "SELECT `customer_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`
                FROM `customers` WHERE `customer_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `customer_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`
                FROM `customers`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customerId): int
    {
        $sql = "DELETE FROM `customers` WHERE `customer_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}