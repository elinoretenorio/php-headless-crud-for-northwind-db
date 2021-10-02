<?php

declare(strict_types=1);

namespace Northwind\Tests\Employees;

use PHPUnit\Framework\TestCase;
use Northwind\Employees\{ EmployeesDto, EmployeesModel, EmployeesController };

class EmployeesControllerTest extends TestCase
{
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;
    private $service;
    private $request;
    private $stream;
    private EmployeesController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "employee_id" => 2488,
            "last_name" => "wide",
            "first_name" => "mind",
            "title" => "top",
            "title_of_courtesy" => "condition",
            "birth_date" => "2021-09-26",
            "hire_date" => "2021-10-13",
            "address" => "gun",
            "city" => "fast",
            "region" => "from",
            "postal_code" => "election",
            "country" => "born",
            "home_phone" => "fact",
            "extension" => "same",
            "photo" => "Brother sit everything matter.",
            "notes" => "Challenge blood sing risk role machine appear year. Body last nearly phone scientist information range religious. Team two until prevent.",
            "reports_to" => 7851,
            "photo_path" => "turn",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
        $this->service = $this->createMock("Northwind\Employees\IEmployeesService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new EmployeesController(
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
        $id = 3264;
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
        $args = ["employee_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 9235;
        $expected = ["result" => $id];
        $args = ["employee_id" => 4862];

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
        $args = ["employee_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["employee_id" => 2058];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["employee_id"])
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
        $args = ["employee_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 7111;
        $expected = ["result" => $id];
        $args = ["employee_id" => 2715];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["employee_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}