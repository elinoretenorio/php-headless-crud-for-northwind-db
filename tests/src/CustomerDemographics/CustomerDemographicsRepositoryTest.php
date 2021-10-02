<?php

declare(strict_types=1);

namespace Northwind\Tests\CustomerDemographics;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\CustomerDemographics\{ CustomerDemographicsDto, ICustomerDemographicsRepository, CustomerDemographicsRepository };

class CustomerDemographicsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CustomerDemographicsDto $dto;
    private ICustomerDemographicsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "customer_demographics_id" => 2653,
            "customer_type_id" => 8302,
            "customer_desc" => "Improve see movie brother when including. Name couple benefit key. Above account vote interest. Consumer audience method set.",
        ];
        $this->dto = new CustomerDemographicsDto($this->input);
        $this->repository = new CustomerDemographicsRepository($this->db);
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
        $expected = 34;

        $sql = "INSERT INTO `customer_demographics` (`customer_type_id`, `customer_desc`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerTypeId,
                $this->dto->customerDesc
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
        $expected = 8488;

        $sql = "UPDATE `customer_demographics` SET `customer_type_id` = ?, `customer_desc` = ?
                WHERE `customer_demographics_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerTypeId,
                $this->dto->customerDesc,
                $this->dto->customerDemographicsId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $customerDemographicsId = 9774;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($customerDemographicsId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $customerDemographicsId = 4942;

        $sql = "SELECT `customer_demographics_id`, `customer_type_id`, `customer_desc`
                FROM `customer_demographics` WHERE `customer_demographics_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerDemographicsId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($customerDemographicsId);
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
        $sql = "SELECT `customer_demographics_id`, `customer_type_id`, `customer_desc`
                FROM `customer_demographics`";

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
        $customerDemographicsId = 4783;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($customerDemographicsId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customerDemographicsId = 3162;
        $expected = 3290;

        $sql = "DELETE FROM `customer_demographics` WHERE `customer_demographics_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerDemographicsId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($customerDemographicsId);
        $this->assertEquals($expected, $actual);
    }
}