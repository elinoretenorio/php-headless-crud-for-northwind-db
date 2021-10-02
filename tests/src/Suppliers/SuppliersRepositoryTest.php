<?php

declare(strict_types=1);

namespace Northwind\Tests\Suppliers;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\Suppliers\{ SuppliersDto, ISuppliersRepository, SuppliersRepository };

class SuppliersRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private SuppliersDto $dto;
    private ISuppliersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "supplier_id" => 4938,
            "company_name" => "see",
            "contact_name" => "discuss",
            "contact_title" => "control",
            "address" => "opportunity",
            "city" => "third",
            "region" => "second",
            "postal_code" => "standard",
            "country" => "pay",
            "phone" => "history",
            "fax" => "nearly",
            "homepage" => "Those option dinner open dog. Travel skill mean decade evening in school check. Everyone thank soldier majority item market.",
        ];
        $this->dto = new SuppliersDto($this->input);
        $this->repository = new SuppliersRepository($this->db);
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
        $expected = 7365;

        $sql = "INSERT INTO `suppliers` (`company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`, `homepage`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
                $this->dto->homepage
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
        $expected = 558;

        $sql = "UPDATE `suppliers` SET `company_name` = ?, `contact_name` = ?, `contact_title` = ?, `address` = ?, `city` = ?, `region` = ?, `postal_code` = ?, `country` = ?, `phone` = ?, `fax` = ?, `homepage` = ?
                WHERE `supplier_id` = ?";

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
                $this->dto->homepage,
                $this->dto->supplierId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $supplierId = 9732;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($supplierId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $supplierId = 391;

        $sql = "SELECT `supplier_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`, `homepage`
                FROM `suppliers` WHERE `supplier_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$supplierId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($supplierId);
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
        $sql = "SELECT `supplier_id`, `company_name`, `contact_name`, `contact_title`, `address`, `city`, `region`, `postal_code`, `country`, `phone`, `fax`, `homepage`
                FROM `suppliers`";

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
        $supplierId = 4244;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($supplierId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $supplierId = 7934;
        $expected = 7706;

        $sql = "DELETE FROM `suppliers` WHERE `supplier_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$supplierId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($supplierId);
        $this->assertEquals($expected, $actual);
    }
}