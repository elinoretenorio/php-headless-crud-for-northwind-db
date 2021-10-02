<?php

declare(strict_types=1);

namespace Northwind\Tests\Orders;

use PHPUnit\Framework\TestCase;
use Northwind\Orders\{ OrdersDto, OrdersModel, OrdersController };

class OrdersControllerTest extends TestCase
{
    private array $input;
    private OrdersDto $dto;
    private OrdersModel $model;
    private $service;
    private $request;
    private $stream;
    private OrdersController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "order_id" => 4666,
            "customer_id" => 2352,
            "employee_id" => 1304,
            "order_date" => "2021-10-13",
            "required_date" => "2021-10-05",
            "shipped_date" => "2021-10-13",
            "ship_via" => 3355,
            "freight" => 698.99,
            "ship_name" => "necessary",
            "ship_address" => "assume",
            "ship_city" => "show",
            "ship_region" => "third",
            "ship_postal_code" => "when",
            "ship_country" => "media",
        ];
        $this->dto = new OrdersDto($this->input);
        $this->model = new OrdersModel($this->dto);
        $this->service = $this->createMock("Northwind\Orders\IOrdersService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new OrdersController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 880;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["order_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 8971;
        $expected = ["result" => $id];
        $args = ["order_id" => 4607];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["order_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["order_id" => 2112];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["order_id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["order_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 2945;
        $expected = ["result" => $id];
        $args = ["order_id" => 4841];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["order_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}