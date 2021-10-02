<?php

declare(strict_types=1);

namespace Northwind\Tests\CustomerDemo;

use PHPUnit\Framework\TestCase;
use Northwind\CustomerDemo\{ CustomerDemoDto, CustomerDemoModel };

class CustomerDemoModelTest extends TestCase
{
    private array $input;
    private CustomerDemoDto $dto;
    private CustomerDemoModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "customer_demo_id" => 2135,
            "customer_id" => 2453,
            "customer_type_id" => 8087,
        ];
        $this->dto = new CustomerDemoDto($this->input);
        $this->model = new CustomerDemoModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomerDemoModel(null);

        $this->assertInstanceOf(CustomerDemoModel::class, $model);
    }

    public function testGetCustomerDemoId(): void
    {
        $this->assertEquals($this->dto->customerDemoId, $this->model->getCustomerDemoId());
    }

    public function testSetCustomerDemoId(): void
    {
        $expected = 7585;
        $model = $this->model;
        $model->setCustomerDemoId($expected);

        $this->assertEquals($expected, $model->getCustomerDemoId());
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 4088;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetCustomerTypeId(): void
    {
        $this->assertEquals($this->dto->customerTypeId, $this->model->getCustomerTypeId());
    }

    public function testSetCustomerTypeId(): void
    {
        $expected = 5379;
        $model = $this->model;
        $model->setCustomerTypeId($expected);

        $this->assertEquals($expected, $model->getCustomerTypeId());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}