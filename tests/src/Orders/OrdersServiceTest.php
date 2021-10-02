<?php

declare(strict_types=1);

namespace Northwind\Tests\Orders;

use PHPUnit\Framework\TestCase;
use Northwind\Orders\{ OrdersDto, OrdersModel, IOrdersService, OrdersService };

class OrdersServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private OrdersDto $dto;
    private OrdersModel $model;
    private IOrdersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Orders\IOrdersRepository");
        $this->input = [
            "order_id" => 8720,
            "customer_id" => 8835,
            "employee_id" => 405,
            "order_date" => "2021-09-25",
            "required_date" => "2021-09-17",
            "shipped_date" => "2021-09-26",
            "ship_via" => 6074,
            "freight" => 522.38,
            "ship_name" => "appear",
            "ship_address" => "main",
            "ship_city" => "situation",
            "ship_region" => "media",
            "ship_postal_code" => "daughter",
            "ship_country" => "on",
        ];
        $this->dto = new OrdersDto($this->input);
        $this->model = new OrdersModel($this->dto);
        $this->service = new OrdersService($this->repository);
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
        $expected = 5739;

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
        $expected = 2256;

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
        $orderId = 2486;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderId)
            ->willReturn(null);

        $actual = $this->service->get($orderId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $orderId = 3682;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($orderId)
            ->willReturn($this->dto);

        $actual = $this->service->get($orderId);
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
        $orderId = 8365;
        $expected = 496;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($orderId)
            ->willReturn($expected);

        $actual = $this->service->delete($orderId);
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