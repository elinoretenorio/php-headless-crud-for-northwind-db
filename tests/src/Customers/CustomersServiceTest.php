<?php

declare(strict_types=1);

namespace Northwind\Tests\Customers;

use PHPUnit\Framework\TestCase;
use Northwind\Customers\{ CustomersDto, CustomersModel, ICustomersService, CustomersService };

class CustomersServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CustomersDto $dto;
    private CustomersModel $model;
    private ICustomersService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Customers\ICustomersRepository");
        $this->input = [
            "customer_id" => 3840,
            "company_name" => "field",
            "contact_name" => "reflect",
            "contact_title" => "perhaps",
            "address" => "half",
            "city" => "control",
            "region" => "politics",
            "postal_code" => "make",
            "country" => "thought",
            "phone" => "else",
            "fax" => "entire",
        ];
        $this->dto = new CustomersDto($this->input);
        $this->model = new CustomersModel($this->dto);
        $this->service = new CustomersService($this->repository);
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
        $expected = 8272;

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
        $expected = 5194;

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
        $customerId = 6808;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerId)
            ->willReturn(null);

        $actual = $this->service->get($customerId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $customerId = 8471;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($customerId)
            ->willReturn($this->dto);

        $actual = $this->service->get($customerId);
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
        $customerId = 4861;
        $expected = 4536;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($customerId)
            ->willReturn($expected);

        $actual = $this->service->delete($customerId);
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