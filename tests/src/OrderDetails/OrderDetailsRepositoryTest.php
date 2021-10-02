<?php

declare(strict_types=1);

namespace Northwind\Tests\OrderDetails;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\OrderDetails\{ OrderDetailsDto, IOrderDetailsRepository, OrderDetailsRepository };

class OrderDetailsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private OrderDetailsDto $dto;
    private IOrderDetailsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "order_details_id" => 797,
            "order_id" => 3403,
            "product_id" => 4673,
            "unit_price" => 327.98,
            "quantity" => 6682,
            "discount" => 12.61,
        ];
        $this->dto = new OrderDetailsDto($this->input);
        $this->repository = new OrderDetailsRepository($this->db);
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
        $expected = 7801;

        $sql = "INSERT INTO `order_details` (`order_id`, `product_id`, `unit_price`, `quantity`, `discount`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->orderId,
                $this->dto->productId,
                $this->dto->unitPrice,
                $this->dto->quantity,
                $this->dto->discount
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
        $expected = 8038;

        $sql = "UPDATE `order_details` SET `order_id` = ?, `product_id` = ?, `unit_price` = ?, `quantity` = ?, `discount` = ?
                WHERE `order_details_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->orderId,
                $this->dto->productId,
                $this->dto->unitPrice,
                $this->dto->quantity,
                $this->dto->discount,
                $this->dto->orderDetailsId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $orderDetailsId = 7801;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($orderDetailsId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $orderDetailsId = 5075;

        $sql = "SELECT `order_details_id`, `order_id`, `product_id`, `unit_price`, `quantity`, `discount`
                FROM `order_details` WHERE `order_details_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderDetailsId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($orderDetailsId);
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
        $sql = "SELECT `order_details_id`, `order_id`, `product_id`, `unit_price`, `quantity`, `discount`
                FROM `order_details`";

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
        $orderDetailsId = 2967;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($orderDetailsId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $orderDetailsId = 6146;
        $expected = 5650;

        $sql = "DELETE FROM `order_details` WHERE `order_details_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$orderDetailsId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($orderDetailsId);
        $this->assertEquals($expected, $actual);
    }
}