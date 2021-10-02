<?php

declare(strict_types=1);

namespace Northwind\Tests\Territories;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\Territories\{ TerritoriesDto, ITerritoriesRepository, TerritoriesRepository };

class TerritoriesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private TerritoriesDto $dto;
    private ITerritoriesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "territory_id" => 1865,
            "territory_description" => 8469,
            "region_id" => 3067,
        ];
        $this->dto = new TerritoriesDto($this->input);
        $this->repository = new TerritoriesRepository($this->db);
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
        $expected = 3076;

        $sql = "INSERT INTO `territories` (`territory_description`, `region_id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->territoryDescription,
                $this->dto->regionId
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
        $expected = 1891;

        $sql = "UPDATE `territories` SET `territory_description` = ?, `region_id` = ?
                WHERE `territory_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->territoryDescription,
                $this->dto->regionId,
                $this->dto->territoryId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $territoryId = 9038;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($territoryId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $territoryId = 9844;

        $sql = "SELECT `territory_id`, `territory_description`, `region_id`
                FROM `territories` WHERE `territory_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$territoryId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($territoryId);
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
        $sql = "SELECT `territory_id`, `territory_description`, `region_id`
                FROM `territories`";

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
        $territoryId = 5365;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($territoryId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $territoryId = 8088;
        $expected = 8821;

        $sql = "DELETE FROM `territories` WHERE `territory_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$territoryId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($territoryId);
        $this->assertEquals($expected, $actual);
    }
}