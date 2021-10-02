<?php

declare(strict_types=1);

namespace Northwind\Tests\Shippers;

use PHPUnit\Framework\TestCase;
use Northwind\Shippers\{ ShippersDto, ShippersModel };

class ShippersModelTest extends TestCase
{
    private array $input;
    private ShippersDto $dto;
    private ShippersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "shipper_id" => 5004,
            "company_name" => "discover",
            "phone" => "might",
        ];
        $this->dto = new ShippersDto($this->input);
        $this->model = new ShippersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ShippersModel(null);

        $this->assertInstanceOf(ShippersModel::class, $model);
    }

    public function testGetShipperId(): void
    {
        $this->assertEquals($this->dto->shipperId, $this->model->getShipperId());
    }

    public function testSetShipperId(): void
    {
        $expected = 3198;
        $model = $this->model;
        $model->setShipperId($expected);

        $this->assertEquals($expected, $model->getShipperId());
    }

    public function testGetCompanyName(): void
    {
        $this->assertEquals($this->dto->companyName, $this->model->getCompanyName());
    }

    public function testSetCompanyName(): void
    {
        $expected = "hundred";
        $model = $this->model;
        $model->setCompanyName($expected);

        $this->assertEquals($expected, $model->getCompanyName());
    }

    public function testGetPhone(): void
    {
        $this->assertEquals($this->dto->phone, $this->model->getPhone());
    }

    public function testSetPhone(): void
    {
        $expected = "condition";
        $model = $this->model;
        $model->setPhone($expected);

        $this->assertEquals($expected, $model->getPhone());
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