<?php

declare(strict_types=1);

namespace Northwind\Tests\OrderDetails;

use PHPUnit\Framework\TestCase;
use Northwind\OrderDetails\{ OrderDetailsDto, OrderDetailsModel, IOrderDetailsService, OrderDetailsService };

class OrderDetailsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private OrderDetailsDto $dto;
    private OrderDetailsModel $model;
    private IOrderDetailsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\OrderDetails\IOrderDetailsRepository");
        $this->input = [
            "order_details_id" => 7189,
            "order_id" => 2478,
            "product_id" => 7592,
            "unit_price" => 419.40,
            "quantity" => 150,
            "discount" => 823.45,
        ];
        $this->dto = new OrderDetailsDto($this->input);
        $this->model = new OrderDetailsModel($this->dto);
        $this->service = new OrderDetailsService($this->repository);
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
        $expected = 3409;

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
        $expected = 806;

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
        $orderDetailsId = 4621;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderDetailsId)
            ->willReturn(null);

        $actual = $this->service->get($orderDetailsId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $orderDetailsId = 8239;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderDetailsId)
            ->willReturn($this->dto);

        $actual = $this->service->get($orderDetailsId);
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
        $orderDetailsId = 9014;
        $expected = 5830;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($orderDetailsId)
            ->willReturn($expected);

        $actual = $this->service->delete($orderDetailsId);
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