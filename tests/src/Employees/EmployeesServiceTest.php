<?php

declare(strict_types=1);

namespace Northwind\Tests\Employees;

use PHPUnit\Framework\TestCase;
use Northwind\Employees\{ EmployeesDto, EmployeesModel, IEmployeesService, EmployeesService };

class EmployeesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;
    private IEmployeesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Employees\IEmployeesRepository");
        $this->input = [
            "employee_id" => 7062,
            "last_name" => "cup",
            "first_name" => "north",
            "title" => "standard",
            "title_of_courtesy" => "us",
            "birth_date" => "2021-10-07",
            "hire_date" => "2021-10-02",
            "address" => "explain",
            "city" => "nothing",
            "region" => "detail",
            "postal_code" => "special",
            "country" => "treat",
            "home_phone" => "which",
            "extension" => "Mrs",
            "photo" => "Right through onto money road word.",
            "notes" => "Try attention effort wait former. Figure situation easy high analysis.",
            "reports_to" => 5155,
            "photo_path" => "bank",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
        $this->service = new EmployeesService($this->repository);
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
        $expected = 8355;

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
        $expected = 1674;

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
        $employeeId = 528;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeId)
            ->willReturn(null);

        $actual = $this->service->get($employeeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $employeeId = 5896;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($employeeId);
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
        $employeeId = 3474;
        $expected = 4087;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($employeeId)
            ->willReturn($expected);

        $actual = $this->service->delete($employeeId);
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