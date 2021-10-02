<?php

declare(strict_types=1);

namespace Northwind\Tests\Suppliers;

use PHPUnit\Framework\TestCase;
use Northwind\Suppliers\{ SuppliersDto, SuppliersModel, ISuppliersService, SuppliersService };

class SuppliersServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private SuppliersDto $dto;
    private SuppliersModel $model;
    private ISuppliersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Suppliers\ISuppliersRepository");
        $this->input = [
            "supplier_id" => 1562,
            "company_name" => "herself",
            "contact_name" => "night",
            "contact_title" => "three",
            "address" => "particular",
            "city" => "apply",
            "region" => "race",
            "postal_code" => "outside",
            "country" => "also",
            "phone" => "door",
            "fax" => "today",
            "homepage" => "Above issue provide painting tend eat ask. Scene toward management author value every.",
        ];
        $this->dto = new SuppliersDto($this->input);
        $this->model = new SuppliersModel($this->dto);
        $this->service = new SuppliersService($this->repository);
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
        $expected = 7029;

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
        $expected = 2745;

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
        $supplierId = 6497;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($supplierId)
            ->willReturn(null);

        $actual = $this->service->get($supplierId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $supplierId = 1408;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($supplierId)
            ->willReturn($this->dto);

        $actual = $this->service->get($supplierId);
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
        $supplierId = 2169;
        $expected = 6966;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($supplierId)
            ->willReturn($expected);

        $actual = $this->service->delete($supplierId);
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