<?php

declare(strict_types=1);

namespace Northwind\Tests\Employees;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\Employees\{ EmployeesDto, IEmployeesRepository, EmployeesRepository };

class EmployeesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private EmployeesDto $dto;
    private IEmployeesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "employee_id" => 1092,
            "last_name" => "face",
            "first_name" => "significant",
            "title" => "evening",
            "title_of_courtesy" => "agent",
            "birth_date" => "2021-10-10",
            "hire_date" => "2021-09-26",
            "address" => "artist",
            "city" => "Republican",
            "region" => "game",
            "postal_code" => "though",
            "country" => "large",
            "home_phone" => "then",
            "extension" => "around",
            "photo" => "Admit place production who tell down.",
            "notes" => "Investment take some lead article marriage. Chance film improve oil five line once. Carry worker try level management human. Positive black election spend professor water.",
            "reports_to" => 8890,
            "photo_path" => "religious",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->repository = new EmployeesRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 4218;

        $sql = "INSERT INTO `employees` (`last_name`, `first_name`, `title`, `title_of_courtesy`, `birth_date`, `hire_date`, `address`, `city`, `region`, `postal_code`, `country`, `home_phone`, `extension`, `photo`, `notes`, `reports_to`, `photo_path`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->lastName,
                $this->dto->firstName,
                $this->dto->title,
                $this->dto->titleOfCourtesy,
                $this->dto->birthDate,
                $this->dto->hireDate,
                $this->dto->address,
                $this->dto->city,
                $this->dto->region,
                $this->dto->postalCode,
                $this->dto->country,
                $this->dto->homePhone,
                $this->dto->extension,
                $this->dto->photo,
                $this->dto->notes,
                $this->dto->reportsTo,
                $this->dto->photoPath
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 7448;

        $sql = "UPDATE `employees` SET `last_name` = ?, `first_name` = ?, `title` = ?, `title_of_courtesy` = ?, `birth_date` = ?, `hire_date` = ?, `address` = ?, `city` = ?, `region` = ?, `postal_code` = ?, `country` = ?, `home_phone` = ?, `extension` = ?, `photo` = ?, `notes` = ?, `reports_to` = ?, `photo_path` = ?
                WHERE `employee_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->lastName,
                $this->dto->firstName,
                $this->dto->title,
                $this->dto->titleOfCourtesy,
                $this->dto->birthDate,
                $this->dto->hireDate,
                $this->dto->address,
                $this->dto->city,
                $this->dto->region,
                $this->dto->postalCode,
                $this->dto->country,
                $this->dto->homePhone,
                $this->dto->extension,
                $this->dto->photo,
                $this->dto->notes,
                $this->dto->reportsTo,
                $this->dto->photoPath,
                $this->dto->employeeId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $employeeId = 8487;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($employeeId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $employeeId = 3796;

        $sql = "SELECT `employee_id`, `last_name`, `first_name`, `title`, `title_of_courtesy`, `birth_date`, `hire_date`, `address`, `city`, `region`, `postal_code`, `country`, `home_phone`, `extension`, `photo`, `notes`, `reports_to`, `photo_path`
                FROM `employees` WHERE `employee_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($employeeId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `employee_id`, `last_name`, `first_name`, `title`, `title_of_courtesy`, `birth_date`, `hire_date`, `address`, `city`, `region`, `postal_code`, `country`, `home_phone`, `extension`, `photo`, `notes`, `reports_to`, `photo_path`
                FROM `employees`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $employeeId = 660;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $employeeId = 7488;
        $expected = 2704;

        $sql = "DELETE FROM `employees` WHERE `employee_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }
}