<?php

declare(strict_types=1);

namespace Northwind\Tests\Products;

use PHPUnit\Framework\TestCase;
use Northwind\Database\DatabaseException;
use Northwind\Products\{ ProductsDto, IProductsRepository, ProductsRepository };

class ProductsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ProductsDto $dto;
    private IProductsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Northwind\Database\IDatabase");
        $this->result = $this->createMock("Northwind\Database\IDatabaseResult");
        $this->input = [
            "product_id" => 9120,
            "product_name" => "south",
            "supplier_id" => 4723,
            "category_id" => 2498,
            "quantity_per_unit" => "positive",
            "unit_price" => 116.16,
            "units_in_stock" => 6431,
            "units_on_order" => 4443,
            "reorder_level" => 3233,
            "discontinued" => "Nature according necessary yourself industry organization.",
        ];
        $this->dto = new ProductsDto($this->input);
        $this->repository = new ProductsRepository($this->db);
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
        $expected = 6242;

        $sql = "INSERT INTO `products` (`product_name`, `supplier_id`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `reorder_level`, `discontinued`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->productName,
                $this->dto->supplierId,
                $this->dto->categoryId,
                $this->dto->quantityPerUnit,
                $this->dto->unitPrice,
                $this->dto->unitsInStock,
                $this->dto->unitsOnOrder,
                $this->dto->reorderLevel,
                $this->dto->discontinued
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
        $expected = 3171;

        $sql = "UPDATE `products` SET `product_name` = ?, `supplier_id` = ?, `category_id` = ?, `quantity_per_unit` = ?, `unit_price` = ?, `units_in_stock` = ?, `units_on_order` = ?, `reorder_level` = ?, `discontinued` = ?
                WHERE `product_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->productName,
                $this->dto->supplierId,
                $this->dto->categoryId,
                $this->dto->quantityPerUnit,
                $this->dto->unitPrice,
                $this->dto->unitsInStock,
                $this->dto->unitsOnOrder,
                $this->dto->reorderLevel,
                $this->dto->discontinued,
                $this->dto->productId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $productId = 4894;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($productId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $productId = 5480;

        $sql = "SELECT `product_id`, `product_name`, `supplier_id`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `reorder_level`, `discontinued`
                FROM `products` WHERE `product_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($productId);
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
        $sql = "SELECT `product_id`, `product_name`, `supplier_id`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `reorder_level`, `discontinued`
                FROM `products`";

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
        $productId = 1750;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($productId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $productId = 7384;
        $expected = 7388;

        $sql = "DELETE FROM `products` WHERE `product_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($productId);
        $this->assertEquals($expected, $actual);
    }
}