<?php

declare(strict_types=1);

namespace Northwind\CustomerDemographics;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class CustomerDemographicsRepository implements ICustomerDemographicsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CustomerDemographicsDto $dto): int
    {
        $sql = "INSERT INTO `customer_demographics` (`customer_type_id`, `customer_desc`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerTypeId,
                $dto->customerDesc
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CustomerDemographicsDto $dto): int
    {
        $sql = "UPDATE `customer_demographics` SET `customer_type_id` = ?, `customer_desc` = ?
                WHERE `customer_demographics_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerTypeId,
                $dto->customerDesc,
                $dto->customerDemographicsId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $customerDemographicsId): ?CustomerDemographicsDto
    {
        $sql = "SELECT `customer_demographics_id`, `customer_type_id`, `customer_desc`
                FROM `customer_demographics` WHERE `customer_demographics_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerDemographicsId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CustomerDemographicsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `customer_demographics_id`, `customer_type_id`, `customer_desc`
                FROM `customer_demographics`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CustomerDemographicsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $customerDemographicsId): int
    {
        $sql = "DELETE FROM `customer_demographics` WHERE `customer_demographics_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$customerDemographicsId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}