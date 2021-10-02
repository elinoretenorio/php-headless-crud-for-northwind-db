<?php

declare(strict_types=1);

namespace Northwind\Tests\EmployeeTerritories;

use PHPUnit\Framework\TestCase;
use Northwind\EmployeeTerritories\{ EmployeeTerritoriesDto, EmployeeTerritoriesModel, IEmployeeTerritoriesService, EmployeeTerritoriesService };

class EmployeeTerritoriesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private EmployeeTerritoriesDto $dto;
    private EmployeeTerritoriesModel $model;
    private IEmployeeTerritoriesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\EmployeeTerritories\IEmployeeTerritoriesRepository");
        $this->input = [
            "employee_territories_id" => 4480,
            "employee_id" => 8391,
            "territory_id" => "Parent little once specific court.",
        ];
        $this->dto = new EmployeeTerritoriesDto($this->input);
        $this->model = new EmployeeTerritoriesModel($this->dto);
        $this->service = new EmployeeTerritoriesService($this->repository);
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
        $expected = 8931;

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
        $expected = 831;

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
        $employeeTerritoriesId = 7684;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeTerritoriesId)
            ->willReturn(null);

        $actual = $this->service->get($employeeTerritoriesId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $employeeTerritoriesId = 8633;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeTerritoriesId)
            ->willReturn($this->dto);

        $actual = $this->service->get($employeeTerritoriesId);
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
        $employeeTerritoriesId = 7772;
        $expected = 3869;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($employeeTerritoriesId)
            ->willReturn($expected);

        $actual = $this->service->delete($employeeTerritoriesId);
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