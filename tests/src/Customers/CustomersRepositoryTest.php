<?php

declare(strict_types=1);

namespace Northwind\Tests\Customers;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\Customers\{ CustomersDto, ICustomersRepository, CustomersRepository };

class CustomersRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CustomersDto $dto;
    private ICustomersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "customer_id" => 5807,
            "company_name" => "fine",
            "contact_name" => "single",
            "contact_title" => "throughout",
            "address" => "carry",
            "city" => "spend",
            "region" => "others",
            "postal_code" => "car",
            "country" => "couple",
            "phone" => "size",
            "fax" => "company",
        ];
        $this->dto = new CustomersDto($this->input);
        $this->repository = new CustomersRepository($this->db);
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
        $expected = 1050;

        $sql = "INSERT INTO `customers` (`company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->companyName,
                $this->dto->contactName,
                $this->dto->contactTitle,
                $this->dto->address,
                $this->dto->city,
                $this->dto->region,
                $this->dto->postalCode,
                $this->dto->country,
                $this->dto->phone,
                $this->dto->fax
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
        $expected = 2091;

        $sql = "UPDATE `customers` SET `company_name` = ?, `contact_name` = ?, `contact_title` = ?, `address` = ?, `city` = ?, `region` = ?, `postal_code` = ?, `country` = ?, `phone` = ?, `fax` = ?
                WHERE `customer_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->companyName,
                $this->dto->contactName,
                $this->dto->contactTitle,
                $this->dto->address,
                $this->dto->city,
                $this->dto->region,
                $this->dto->postalCode,
                $this->dto->country,
                $this->dto->phone,
                $this->dto->fax,
                $this->dto->customerId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $customerId = 3979;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($customerId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $customerId = 5457;

        $sql = "SELECT `customer_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`
                FROM `customers` WHERE `customer_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($customerId);
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
        $sql = "SELECT `customer_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`
                FROM `customers`";

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
        $customerId = 5502;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($customerId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $customerId = 4280;
        $expected = 9093;

        $sql = "DELETE FROM `customers` WHERE `customer_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$customerId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($customerId);
        $this->assertEquals($expected, $actual);
    }
}