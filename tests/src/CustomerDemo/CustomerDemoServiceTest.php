<?php

declare(strict_types=1);

namespace Northwind\Tests\CustomerDemo;

use PHPUnit\Framework\TestCase;
use Northwind\CustomerDemo\{ CustomerDemoDto, CustomerDemoModel, ICustomerDemoService, CustomerDemoService };

class CustomerDemoServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CustomerDemoDto $dto;
    private CustomerDemoModel $model;
    private ICustomerDemoService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\CustomerDemo\ICustomerDemoRepository");
        $this->input = [
            "customer_demo_id" => 200,
            "customer_id" => 7799,
            "customer_type_id" => 3844,
        ];
        $this->dto = new CustomerDemoDto($this->input);
        $this->model = new CustomerDemoModel($this->dto);
        $this->service = new CustomerDemoService($this->repository);
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
        $expected = 2439;

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
        $expected = 5716;

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
        $customerDemoId = 7716;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerDemoId)
            ->willReturn(null);

        $actual = $this->service->get($customerDemoId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customerDemoId = 8578;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerDemoId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customerDemoId);
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
        $customerDemoId = 5757;
        $expected = 379;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customerDemoId)
            ->willReturn($expected);

        $actual = $this->service->delete($customerDemoId);
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