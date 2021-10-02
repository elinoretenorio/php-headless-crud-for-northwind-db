<?php

declare(strict_types=1);

namespace Northwind\Tests\Region;

use PHPUnit\Framework\TestCase;
use Northwind\Region\{ RegionDto, RegionModel, IRegionService, RegionService };

class RegionServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private RegionDto $dto;
    private RegionModel $model;
    private IRegionService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Region\IRegionRepository");
        $this->input = [
            "region_id" => 6531,
            "region_description" => 4226,
        ];
        $this->dto = new RegionDto($this->input);
        $this->model = new RegionModel($this->dto);
        $this->service = new RegionService($this->repository);
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
        $expected = 4039;

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
        $expected = 5897;

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
        $regionId = 5400;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($regionId)
            ->willReturn(null);

        $actual = $this->service->get($regionId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $regionId = 1010;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($regionId)
            ->willReturn($this->dto);

        $actual = $this->service->get($regionId);
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
        $regionId = 4413;
        $expected = 6308;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($regionId)
            ->willReturn($expected);

        $actual = $this->service->delete($regionId);
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