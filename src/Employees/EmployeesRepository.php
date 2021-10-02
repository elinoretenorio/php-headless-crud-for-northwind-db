<?php

declare(strict_types=1);

namespace Northwind\Employees;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class EmployeesRepository implements IEmployeesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(EmployeesDto $dto): int
    {
        $sql = "INSERT INTO `employees` (`last_name`, `first_name`, `title`, `title_of_courtesy`, `birth_date`, `hire_date`, `address`, `city`, `region`, `postal_code`, `country`, `home_phone`, `extension`, `photo`, `notes`, `reports_to`, `photo_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->lastName,
                $dto->firstName,
                $dto->title,
                $dto->titleOfCourtesy,
                $dto->birthDate,
                $dto->hireDate,
                $dto->address,
                $dto->city,
                $dto->region,
                $dto->postalCode,
                $dto->country,
                $dto->homePhone,
                $dto->extension,
                $dto->photo,
                $dto->notes,
                $dto->reportsTo,
                $dto->photoPath
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(EmployeesDto $dto): int
    {
        $sql = "UPDATE `employees` SET `last_name` = ?, `first_name` = ?, `title` = ?, `title_of_courtesy` = ?, `birth_date` = ?, `hire_date` = ?, `address` = ?, `city` = ?, `region` = ?, `postal_code` = ?, `country` = ?, `home_phone` = ?, `extension` = ?, `photo` = ?, `notes` = ?, `reports_to` = ?, `photo_path` = ?
                WHERE `employee_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->lastName,
                $dto->firstName,
                $dto->title,
                $dto->titleOfCourtesy,
                $dto->birthDate,
                $dto->hireDate,
                $dto->address,
                $dto->city,
                $dto->region,
                $dto->postalCode,
                $dto->country,
                $dto->homePhone,
                $dto->extension,
                $dto->photo,
                $dto->notes,
                $dto->reportsTo,
                $dto->photoPath,
                $dto->employeeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $employeeId): ?EmployeesDto
    {
        $sql = "SELECT `employee_id`, `last_name`, `first_name`, `title`, `title_of_courtesy`, `birth_date`, `hire_date`, `address`, `city`, `region`, `postal_code`, `country`, `home_phone`, `extension`, `photo`, `notes`, `reports_to`, `photo_path`
                FROM `employees` WHERE `employee_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new EmployeesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `employee_id`, `last_name`, `first_name`, `title`, `title_of_courtesy`, `birth_date`, `hire_date`, `address`, `city`, `region`, `postal_code`, `country`, `home_phone`, `extension`, `photo`, `notes`, `reports_to`, `photo_path`
                FROM `employees`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new EmployeesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $employeeId): int
    {
        $sql = "DELETE FROM `employees` WHERE `employee_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}