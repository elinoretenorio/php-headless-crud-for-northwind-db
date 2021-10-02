<?php

declare(strict_types=1);

namespace Northwind\Tests\Suppliers;

use PHPUnit\Framework\TestCase;
use Northwind\Suppliers\{ SuppliersDto, SuppliersModel, SuppliersController };

class SuppliersControllerTest extends TestCase
{
    private array $input;
    private SuppliersDto $dto;
    private SuppliersModel $model;
    private $service;
    private $request;
    private $stream;
    private SuppliersController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "supplier_id" => 308,
            "company_name" => "tough",
            "contact_name" => "center",
            "contact_title" => "ok",
            "address" => "model",
            "city" => "will",
            "region" => "anyone",
            "postal_code" => "head",
            "country" => "population",
            "phone" => "police",
            "fax" => "crime",
            "homepage" => "Five develop ground action. Cause on name reason.",
        ];
        $this->dto = new SuppliersDto($this->input);
        $this->model = new SuppliersModel($this->dto);
        $this->service = $this->createMock("Northwind\Suppliers\ISuppliersService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new SuppliersController(
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
        $id = 2520;
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
        $args = ["supplier_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 3257;
        $expected = ["result" => $id];
        $args = ["supplier_id" => 7025];

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
        $args = ["supplier_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["supplier_id" => 2042];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["supplier_id"])
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
        $args = ["supplier_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 4560;
        $expected = ["result" => $id];
        $args = ["supplier_id" => 3737];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["supplier_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}