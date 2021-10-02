<?php

declare(strict_types=1);

namespace Northwind\CustomerDemo;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class CustomerDemoRepository implements ICustomerDemoRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomerDemoDto $dto): int
    {
        $sql = "INSERT INTO `customer_demo` (`customer_id`, `customer_type_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->customerTypeId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomerDemoDto $dto): int
    {
        $sql = "UPDATE `customer_demo` SET `customer_id` = ?, `customer_type_id` = ?
                WHERE `customer_demo_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->customerTypeId,
                $dto->customerDemoId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customerDemoId): ?CustomerDemoDto
    {
        $sql = "SELECT `customer_demo_id`, `customer_id`, `customer_type_id`
                FROM `customer_demo` WHERE `customer_demo_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerDemoId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomerDemoDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `customer_demo_id`, `customer_id`, `customer_type_id`
                FROM `customer_demo`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomerDemoDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customerDemoId): int
    {
        $sql = "DELETE FROM `customer_demo` WHERE `customer_demo_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerDemoId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}