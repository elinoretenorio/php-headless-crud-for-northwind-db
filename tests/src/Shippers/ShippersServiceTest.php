<?php

declare(strict_types=1);

namespace Northwind\Tests\Shippers;

use PHPUnit\Framework\TestCase;
use Northwind\Shippers\{ ShippersDto, ShippersModel, IShippersService, ShippersService };

class ShippersServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ShippersDto $dto;
    private ShippersModel $model;
    private IShippersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Shippers\IShippersRepository");
        $this->input = [
            "shipper_id" => 3496,
            "company_name" => "day",
            "phone" => "player",
        ];
        $this->dto = new ShippersDto($this->input);
        $this->model = new ShippersModel($this->dto);
        $this->service = new ShippersService($this->repository);
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
        $expected = 3593;

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
        $expected = 8430;

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
        $shipperId = 5163;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($shipperId)
            ->willReturn(null);

        $actual = $this->service->get($shipperId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $shipperId = 4748;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($shipperId)
            ->willReturn($this->dto);

        $actual = $this->service->get($shipperId);
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
        $shipperId = 4268;
        $expected = 1447;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($shipperId)
            ->willReturn($expected);

        $actual = $this->service->delete($shipperId);
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