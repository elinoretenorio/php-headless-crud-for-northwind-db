<?php

declare(strict_types=1);

namespace Northwind\Tests\CustomerDemographics;

use PHPUnit\Framework\TestCase;
use Northwind\CustomerDemographics\{ CustomerDemographicsDto, CustomerDemographicsModel };

class CustomerDemographicsModelTest extends TestCase
{
    private array $input;
    private CustomerDemographicsDto $dto;
    private CustomerDemographicsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "customer_demographics_id" => 5791,
            "customer_type_id" => 4207,
            "customer_desc" => "Medical movie push contain. Also price could him service recently.",
        ];
        $this->dto = new CustomerDemographicsDto($this->input);
        $this->model = new CustomerDemographicsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomerDemographicsModel(null);

        $this->assertInstanceOf(CustomerDemographicsModel::class, $model);
    }

    public function testGetCustomerDemographicsId(): void
    {
        $this->assertEquals($this->dto->customerDemographicsId, $this->model->getCustomerDemographicsId());
    }

    public function testSetCustomerDemographicsId(): void
    {
        $expected = 5763;
        $model = $this->model;
        $model->setCustomerDemographicsId($expected);

        $this->assertEquals($expected, $model->getCustomerDemographicsId());
    }

    public function testGetCustomerTypeId(): void
    {
        $this->assertEquals($this->dto->customerTypeId, $this->model->getCustomerTypeId());
    }

    public function testSetCustomerTypeId(): void
    {
        $expected = 387;
        $model = $this->model;
        $model->setCustomerTypeId($expected);

        $this->assertEquals($expected, $model->getCustomerTypeId());
    }

    public function testGetCustomerDesc(): void
    {
        $this->assertEquals($this->dto->customerDesc, $this->model->getCustomerDesc());
    }

    public function testSetCustomerDesc(): void
    {
        $expected = "Each agreement bit question. Herself child final attorney answer look consumer.";
        $model = $this->model;
        $model->setCustomerDesc($expected);

        $this->assertEquals($expected, $model->getCustomerDesc());
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