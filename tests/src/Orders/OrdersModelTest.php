<?php

declare(strict_types=1);

namespace Northwind\Tests\Orders;

use PHPUnit\Framework\TestCase;
use Northwind\Orders\{ OrdersDto, OrdersModel };

class OrdersModelTest extends TestCase
{
    private array $input;
    private OrdersDto $dto;
    private OrdersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "order_id" => 2495,
            "customer_id" => 7435,
            "employee_id" => 602,
            "order_date" => "2021-09-22",
            "required_date" => "2021-09-29",
            "shipped_date" => "2021-09-21",
            "ship_via" => 2803,
            "freight" => 904.00,
            "ship_name" => "civil",
            "ship_address" => "kitchen",
            "ship_city" => "democratic",
            "ship_region" => "number",
            "ship_postal_code" => "treatment",
            "ship_country" => "side",
        ];
        $this->dto = new OrdersDto($this->input);
        $this->model = new OrdersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new OrdersModel(null);

        $this->assertInstanceOf(OrdersModel::class, $model);
    }

    public function testGetOrderId(): void
    {
        $this->assertEquals($this->dto->orderId, $this->model->getOrderId());
    }

    public function testSetOrderId(): void
    {
        $expected = 8964;
        $model = $this->model;
        $model->setOrderId($expected);

        $this->assertEquals($expected, $model->getOrderId());
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 2318;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetEmployeeId(): void
    {
        $this->assertEquals($this->dto->employeeId, $this->model->getEmployeeId());
    }

    public function testSetEmployeeId(): void
    {
        $expected = 6845;
        $model = $this->model;
        $model->setEmployeeId($expected);

        $this->assertEquals($expected, $model->getEmployeeId());
    }

    public function testGetOrderDate(): void
    {
        $this->assertEquals($this->dto->orderDate, $this->model->getOrderDate());
    }

    public function testSetOrderDate(): void
    {
        $expected = "2021-10-09";
        $model = $this->model;
        $model->setOrderDate($expected);

        $this->assertEquals($expected, $model->getOrderDate());
    }

    public function testGetRequiredDate(): void
    {
        $this->assertEquals($this->dto->requiredDate, $this->model->getRequiredDate());
    }

    public function testSetRequiredDate(): void
    {
        $expected = "2021-09-26";
        $model = $this->model;
        $model->setRequiredDate($expected);

        $this->assertEquals($expected, $model->getRequiredDate());
    }

    public function testGetShippedDate(): void
    {
        $this->assertEquals($this->dto->shippedDate, $this->model->getShippedDate());
    }

    public function testSetShippedDate(): void
    {
        $expected = "2021-10-04";
        $model = $this->model;
        $model->setShippedDate($expected);

        $this->assertEquals($expected, $model->getShippedDate());
    }

    public function testGetShipVia(): void
    {
        $this->assertEquals($this->dto->shipVia, $this->model->getShipVia());
    }

    public function testSetShipVia(): void
    {
        $expected = 6593;
        $model = $this->model;
        $model->setShipVia($expected);

        $this->assertEquals($expected, $model->getShipVia());
    }

    public function testGetFreight(): void
    {
        $this->assertEquals($this->dto->freight, $this->model->getFreight());
    }

    public function testSetFreight(): void
    {
        $expected = 350.37;
        $model = $this->model;
        $model->setFreight($expected);

        $this->assertEquals($expected, $model->getFreight());
    }

    public function testGetShipName(): void
    {
        $this->assertEquals($this->dto->shipName, $this->model->getShipName());
    }

    public function testSetShipName(): void
    {
        $expected = "score";
        $model = $this->model;
        $model->setShipName($expected);

        $this->assertEquals($expected, $model->getShipName());
    }

    public function testGetShipAddress(): void
    {
        $this->assertEquals($this->dto->shipAddress, $this->model->getShipAddress());
    }

    public function testSetShipAddress(): void
    {
        $expected = "challenge";
        $model = $this->model;
        $model->setShipAddress($expected);

        $this->assertEquals($expected, $model->getShipAddress());
    }

    public function testGetShipCity(): void
    {
        $this->assertEquals($this->dto->shipCity, $this->model->getShipCity());
    }

    public function testSetShipCity(): void
    {
        $expected = "pressure";
        $model = $this->model;
        $model->setShipCity($expected);

        $this->assertEquals($expected, $model->getShipCity());
    }

    public function testGetShipRegion(): void
    {
        $this->assertEquals($this->dto->shipRegion, $this->model->getShipRegion());
    }

    public function testSetShipRegion(): void
    {
        $expected = "prepare";
        $model = $this->model;
        $model->setShipRegion($expected);

        $this->assertEquals($expected, $model->getShipRegion());
    }

    public function testGetShipPostalCode(): void
    {
        $this->assertEquals($this->dto->shipPostalCode, $this->model->getShipPostalCode());
    }

    public function testSetShipPostalCode(): void
    {
        $expected = "design";
        $model = $this->model;
        $model->setShipPostalCode($expected);

        $this->assertEquals($expected, $model->getShipPostalCode());
    }

    public function testGetShipCountry(): void
    {
        $this->assertEquals($this->dto->shipCountry, $this->model->getShipCountry());
    }

    public function testSetShipCountry(): void
    {
        $expected = "production";
        $model = $this->model;
        $model->setShipCountry($expected);

        $this->assertEquals($expected, $model->getShipCountry());
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