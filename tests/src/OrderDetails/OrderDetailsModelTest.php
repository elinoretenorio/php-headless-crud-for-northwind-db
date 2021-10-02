<?php

declare(strict_types=1);

namespace Northwind\Tests\OrderDetails;

use PHPUnit\Framework\TestCase;
use Northwind\OrderDetails\{ OrderDetailsDto, OrderDetailsModel };

class OrderDetailsModelTest extends TestCase
{
    private array $input;
    private OrderDetailsDto $dto;
    private OrderDetailsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "order_details_id" => 2736,
            "order_id" => 489,
            "product_id" => 4988,
            "unit_price" => 707.51,
            "quantity" => 3397,
            "discount" => 690.26,
        ];
        $this->dto = new OrderDetailsDto($this->input);
        $this->model = new OrderDetailsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new OrderDetailsModel(null);

        $this->assertInstanceOf(OrderDetailsModel::class, $model);
    }

    public function testGetOrderDetailsId(): void
    {
        $this->assertEquals($this->dto->orderDetailsId, $this->model->getOrderDetailsId());
    }

    public function testSetOrderDetailsId(): void
    {
        $expected = 130;
        $model = $this->model;
        $model->setOrderDetailsId($expected);

        $this->assertEquals($expected, $model->getOrderDetailsId());
    }

    public function testGetOrderId(): void
    {
        $this->assertEquals($this->dto->orderId, $this->model->getOrderId());
    }

    public function testSetOrderId(): void
    {
        $expected = 5819;
        $model = $this->model;
        $model->setOrderId($expected);

        $this->assertEquals($expected, $model->getOrderId());
    }

    public function testGetProductId(): void
    {
        $this->assertEquals($this->dto->productId, $this->model->getProductId());
    }

    public function testSetProductId(): void
    {
        $expected = 9512;
        $model = $this->model;
        $model->setProductId($expected);

        $this->assertEquals($expected, $model->getProductId());
    }

    public function testGetUnitPrice(): void
    {
        $this->assertEquals($this->dto->unitPrice, $this->model->getUnitPrice());
    }

    public function testSetUnitPrice(): void
    {
        $expected = 733.31;
        $model = $this->model;
        $model->setUnitPrice($expected);

        $this->assertEquals($expected, $model->getUnitPrice());
    }

    public function testGetQuantity(): void
    {
        $this->assertEquals($this->dto->quantity, $this->model->getQuantity());
    }

    public function testSetQuantity(): void
    {
        $expected = 1795;
        $model = $this->model;
        $model->setQuantity($expected);

        $this->assertEquals($expected, $model->getQuantity());
    }

    public function testGetDiscount(): void
    {
        $this->assertEquals($this->dto->discount, $this->model->getDiscount());
    }

    public function testSetDiscount(): void
    {
        $expected = 908.40;
        $model = $this->model;
        $model->setDiscount($expected);

        $this->assertEquals($expected, $model->getDiscount());
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