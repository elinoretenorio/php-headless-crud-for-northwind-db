<?php

declare(strict_types=1);

namespace Northwind\Tests\EmployeeTerritories;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\EmployeeTerritories\{ EmployeeTerritoriesDto, IEmployeeTerritoriesRepository, EmployeeTerritoriesRepository };

class EmployeeTerritoriesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private EmployeeTerritoriesDto $dto;
    private IEmployeeTerritoriesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "employee_territories_id" => 9324,
            "employee_id" => 9722,
            "territory_id" => "Letter live box situation near care where.",
        ];
        $this->dto = new EmployeeTerritoriesDto($this->input);
        $this->repository = new EmployeeTerritoriesRepository($this->db);
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
        $expected = 4448;

        $sql = "INSERT INTO `employee_territories` (`employee_id`, `territory_id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->employeeId,
                $this->dto->territoryId
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
        $expected = 505;

        $sql = "UPDATE `employee_territories` SET `employee_id` = ?, `territory_id` = ?
                WHERE `employee_territories_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->employeeId,
                $this->dto->territoryId,
                $this->dto->employeeTerritoriesId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $employeeTerritoriesId = 2269;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($employeeTerritoriesId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $employeeTerritoriesId = 1964;

        $sql = "SELECT `employee_territories_id`, `employee_id`, `territory_id`
                FROM `employee_territories` WHERE `employee_territories_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeTerritoriesId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($employeeTerritoriesId);
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
        $sql = "SELECT `employee_territories_id`, `employee_id`, `territory_id`
                FROM `employee_territories`";

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
        $employeeTerritoriesId = 3160;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($employeeTerritoriesId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $employeeTerritoriesId = 7695;
        $expected = 5762;

        $sql = "DELETE FROM `employee_territories` WHERE `employee_territories_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeTerritoriesId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($employeeTerritoriesId);
        $this->assertEquals($expected, $actual);
    }
}