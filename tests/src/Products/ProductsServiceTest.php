<?php

declare(strict_types=1);

namespace Northwind\Tests\Products;

use PHPUnit\Framework\TestCase;
use Northwind\Products\{ ProductsDto, ProductsModel, IProductsService, ProductsService };

class ProductsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ProductsDto $dto;
    private ProductsModel $model;
    private IProductsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Products\IProductsRepository");
        $this->input = [
            "product_id" => 96,
            "product_name" => "goal",
            "supplier_id" => 7053,
            "category_id" => 4736,
            "quantity_per_unit" => "run",
            "unit_price" => 649.37,
            "units_in_stock" => 8661,
            "units_on_order" => 7366,
            "reorder_level" => 6333,
            "discontinued" => "Professional trade party occur young hold.",
        ];
        $this->dto = new ProductsDto($this->input);
        $this->model = new ProductsModel($this->dto);
        $this->service = new ProductsService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 1137;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 3178;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $productId = 9764;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productId)
            ->willReturn(null);

        $actual = $this->service->get($productId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $productId = 7480;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productId)
            ->willReturn($this->dto);

        $actual = $this->service->get($productId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $productId = 6048;
        $expected = 6098;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($productId)
            ->willReturn($expected);

        $actual = $this->service->delete($productId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}