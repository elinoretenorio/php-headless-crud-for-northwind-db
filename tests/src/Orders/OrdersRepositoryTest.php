<?php

declare(strict_types=1);

namespace Northwind\Tests\Orders;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\Orders\{ OrdersDto, IOrdersRepository, OrdersRepository };

class OrdersRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private OrdersDto $dto;
    private IOrdersRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "order_id" => 2564,
            "customer_id" => 5319,
            "employee_id" => 1060,
            "order_date" => "2021-10-09",
            "required_date" => "2021-10-11",
            "shipped_date" => "2021-10-08",
            "ship_via" => 3962,
            "freight" => 884.00,
            "ship_name" => "actually",
            "ship_address" => "political",
            "ship_city" => "writer",
            "ship_region" => "my",
            "ship_postal_code" => "myself",
            "ship_country" => "sell",
        ];
        $this->dto = new OrdersDto($this->input);
        $this->repository = new OrdersRepository($this->db);
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
        $expected = 4268;

        $sql = "INSERT INTO `orders` (`customer_id`, `employee_id`, `order_date`, `required_date`, `shipped_date`, `ship_via`, `freight`, `ship_name`, `ship_address`, `ship_city`, `ship_region`, `ship_postal_code`, `ship_country`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->employeeId,
                $this->dto->orderDate,
                $this->dto->requiredDate,
                $this->dto->shippedDate,
                $this->dto->shipVia,
                $this->dto->freight,
                $this->dto->shipName,
                $this->dto->shipAddress,
                $this->dto->shipCity,
                $this->dto->shipRegion,
                $this->dto->shipPostalCode,
                $this->dto->shipCountry
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
        $expected = 1131;

        $sql = "UPDATE `orders` SET `customer_id` = ?, `employee_id` = ?, `order_date` = ?, `required_date` = ?, `shipped_date` = ?, `ship_via` = ?, `freight` = ?, `ship_name` = ?, `ship_address` = ?, `ship_city` = ?, `ship_region` = ?, `ship_postal_code` = ?, `ship_country` = ?
                WHERE `order_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->customerId,
                $this->dto->employeeId,
                $this->dto->orderDate,
                $this->dto->requiredDate,
                $this->dto->shippedDate,
                $this->dto->shipVia,
                $this->dto->freight,
                $this->dto->shipName,
                $this->dto->shipAddress,
                $this->dto->shipCity,
                $this->dto->shipRegion,
                $this->dto->shipPostalCode,
                $this->dto->shipCountry,
                $this->dto->orderId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $orderId = 8701;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($orderId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $orderId = 1674;

        $sql = "SELECT `order_id`, `customer_id`, `employee_id`, `order_date`, `required_date`, `shipped_date`, `ship_via`, `freight`, `ship_name`, `ship_address`, `ship_city`, `ship_region`, `ship_postal_code`, `ship_country`
                FROM `orders` WHERE `order_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($orderId);
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
        $sql = "SELECT `order_id`, `customer_id`, `employee_id`, `order_date`, `required_date`, `shipped_date`, `ship_via`, `freight`, `ship_name`, `ship_address`, `ship_city`, `ship_region`, `ship_postal_code`, `ship_country`
                FROM `orders`";

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
        $orderId = 2171;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($orderId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $orderId = 2593;
        $expected = 900;

        $sql = "DELETE FROM `orders` WHERE `order_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($orderId);
        $this->assertEquals($expected, $actual);
    }
}