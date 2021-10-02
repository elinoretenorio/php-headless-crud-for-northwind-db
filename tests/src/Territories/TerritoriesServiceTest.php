<?php

declare(strict_types=1);

namespace Northwind\Tests\Territories;

use PHPUnit\Framework\TestCase;
use Northwind\Territories\{ TerritoriesDto, TerritoriesModel, ITerritoriesService, TerritoriesService };

class TerritoriesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private TerritoriesDto $dto;
    private TerritoriesModel $model;
    private ITerritoriesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Territories\ITerritoriesRepository");
        $this->input = [
            "territory_id" => 3411,
            "territory_description" => 8965,
            "region_id" => 6990,
        ];
        $this->dto = new TerritoriesDto($this->input);
        $this->model = new TerritoriesModel($this->dto);
        $this->service = new TerritoriesService($this->repository);
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
        $expected = 3263;

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
        $expected = 1556;

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
        $territoryId = 6117;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($territoryId)
            ->willReturn(null);

        $actual = $this->service->get($territoryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $territoryId = 4202;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($territoryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($territoryId);
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
        $territoryId = 6062;
        $expected = 9876;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($territoryId)
            ->willReturn($expected);

        $actual = $this->service->delete($territoryId);
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