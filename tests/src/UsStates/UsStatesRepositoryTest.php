<?php

declare(strict_types=1);

namespace Northwind\Tests\UsStates;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\UsStates\{ UsStatesDto, IUsStatesRepository, UsStatesRepository };

class UsStatesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private UsStatesDto $dto;
    private IUsStatesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "state_id" => 4528,
            "state_name" => "but",
            "state_abbr" => "student",
            "state_region" => "affect",
        ];
        $this->dto = new UsStatesDto($this->input);
        $this->repository = new UsStatesRepository($this->db);
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
        $expected = 7601;

        $sql = "INSERT INTO `us_states` (`state_name`, `state_abbr`, `state_region`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->stateName,
                $this->dto->stateAbbr,
                $this->dto->stateRegion
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
        $expected = 6496;

        $sql = "UPDATE `us_states` SET `state_name` = ?, `state_abbr` = ?, `state_region` = ?
                WHERE `state_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->stateName,
                $this->dto->stateAbbr,
                $this->dto->stateRegion,
                $this->dto->stateId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $stateId = 1738;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($stateId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $stateId = 8310;

        $sql = "SELECT `state_id`, `state_name`, `state_abbr`, `state_region`
                FROM `us_states` WHERE `state_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$stateId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($stateId);
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
        $sql = "SELECT `state_id`, `state_name`, `state_abbr`, `state_region`
                FROM `us_states`";

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
        $stateId = 4440;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($stateId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $stateId = 3063;
        $expected = 5667;

        $sql = "DELETE FROM `us_states` WHERE `state_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$stateId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($stateId);
        $this->assertEquals($expected, $actual);
    }
}