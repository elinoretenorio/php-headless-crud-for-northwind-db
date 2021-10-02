<?php

declare(strict_types=1);

namespace Northwind\Tests\CustomerDemo;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\CustomerDemo\{ CustomerDemoDto, ICustomerDemoRepository, CustomerDemoRepository };

class CustomerDemoRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CustomerDemoDto $dto;
    private ICustomerDemoRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "customer_demo_id" => 7836,
            "customer_id" => 7660,
            "customer_type_id" => 1344,
        ];
        $this->dto = new CustomerDemoDto($this->input);
        $this->repository = new CustomerDemoRepository($this->db);
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
        $expected = 5083;

        $sql = "INSERT INTO `customer_demo` (`customer_id`, `customer_type_id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->customerTypeId
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
        $expected = 2726;

        $sql = "UPDATE `customer_demo` SET `customer_id` = ?, `customer_type_id` = ?
                WHERE `customer_demo_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->customerTypeId,
                $this->dto->customerDemoId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $customerDemoId = 7234;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($customerDemoId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $customerDemoId = 1527;

        $sql = "SELECT `customer_demo_id`, `customer_id`, `customer_type_id`
                FROM `customer_demo` WHERE `customer_demo_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerDemoId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($customerDemoId);
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
        $sql = "SELECT `customer_demo_id`, `customer_id`, `customer_type_id`
                FROM `customer_demo`";

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
        $customerDemoId = 8488;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($customerDemoId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customerDemoId = 6814;
        $expected = 7777;

        $sql = "DELETE FROM `customer_demo` WHERE `customer_demo_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerDemoId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($customerDemoId);
        $this->assertEquals($expected, $actual);
    }
}