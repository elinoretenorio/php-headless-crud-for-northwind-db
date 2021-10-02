<?php

declare(strict_types=1);

namespace Northwind\Tests\CustomerDemographics;

use PHPUnit\Framework\TestCase;
use Northwind\CustomerDemographics\{ CustomerDemographicsDto, CustomerDemographicsModel, ICustomerDemographicsService, CustomerDemographicsService };

class CustomerDemographicsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CustomerDemographicsDto $dto;
    private CustomerDemographicsModel $model;
    private ICustomerDemographicsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\CustomerDemographics\ICustomerDemographicsRepository");
        $this->input = [
            "customer_demographics_id" => 1365,
            "customer_type_id" => 3790,
            "customer_desc" => "Matter religious fight responsibility high. Candidate woman woman her cover direction red.",
        ];
        $this->dto = new CustomerDemographicsDto($this->input);
        $this->model = new CustomerDemographicsModel($this->dto);
        $this->service = new CustomerDemographicsService($this->repository);
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
        $expected = 1239;

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
        $expected = 2859;

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
        $customerDemographicsId = 1424;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerDemographicsId)
            ->willReturn(null);

        $actual = $this->service->get($customerDemographicsId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customerDemographicsId = 267;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerDemographicsId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customerDemographicsId);
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
        $customerDemographicsId = 8695;
        $expected = 2478;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customerDemographicsId)
            ->willReturn($expected);

        $actual = $this->service->delete($customerDemographicsId);
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