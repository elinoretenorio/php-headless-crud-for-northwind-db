<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class EmployeeTerritoriesRepository implements IEmployeeTerritoriesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(EmployeeTerritoriesDto $dto): int
    {
        $sql = "INSERT INTO `employee_territories` (`employee_id`, `territory_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->employeeId,
                $dto->territoryId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(EmployeeTerritoriesDto $dto): int
    {
        $sql = "UPDATE `employee_territories` SET `employee_id` = ?, `territory_id` = ?
                WHERE `employee_territories_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->employeeId,
                $dto->territoryId,
                $dto->employeeTerritoriesId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $employeeTerritoriesId): ?EmployeeTerritoriesDto
    {
        $sql = "SELECT `employee_territories_id`, `employee_id`, `territory_id`
                FROM `employee_territories` WHERE `employee_territories_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeTerritoriesId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new EmployeeTerritoriesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `employee_territories_id`, `employee_id`, `territory_id`
                FROM `employee_territories`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new EmployeeTerritoriesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $employeeTerritoriesId): int
    {
        $sql = "DELETE FROM `employee_territories` WHERE `employee_territories_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeTerritoriesId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}