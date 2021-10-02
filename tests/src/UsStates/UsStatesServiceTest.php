<?php

declare(strict_types=1);

namespace Northwind\Tests\UsStates;

use PHPUnit\Framework\TestCase;
use Northwind\UsStates\{ UsStatesDto, UsStatesModel, IUsStatesService, UsStatesService };

class UsStatesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private UsStatesDto $dto;
    private UsStatesModel $model;
    private IUsStatesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\UsStates\IUsStatesRepository");
        $this->input = [
            "state_id" => 1604,
            "state_name" => "investment",
            "state_abbr" => "rule",
            "state_region" => "account",
        ];
        $this->dto = new UsStatesDto($this->input);
        $this->model = new UsStatesModel($this->dto);
        $this->service = new UsStatesService($this->repository);
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
        $expected = 1885;

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
        $expected = 5227;

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
        $stateId = 6108;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($stateId)
            ->willReturn(null);

        $actual = $this->service->get($stateId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $stateId = 3377;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($stateId)
            ->willReturn($this->dto);

        $actual = $this->service->get($stateId);
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
        $stateId = 2676;
        $expected = 3466;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($stateId)
            ->willReturn($expected);

        $actual = $this->service->delete($stateId);
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