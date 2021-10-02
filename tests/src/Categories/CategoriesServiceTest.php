<?php

declare(strict_types=1);

namespace Northwind\Tests\Categories;

use PHPUnit\Framework\TestCase;
use Northwind\Categories\{ CategoriesDto, CategoriesModel, ICategoriesService, CategoriesService };

class CategoriesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CategoriesDto $dto;
    private CategoriesModel $model;
    private ICategoriesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Northwind\Categories\ICategoriesRepository");
        $this->input = [
            "category_id" => 7934,
            "category_name" => "fear",
            "description" => "Success street doctor after partner per again. Decide remember today record later at bit. Assume physical may rule unit middle conference.",
            "picture" => "Check mind form yeah visit.",
        ];
        $this->dto = new CategoriesDto($this->input);
        $this->model = new CategoriesModel($this->dto);
        $this->service = new CategoriesService($this->repository);
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
        $expected = 2674;

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
        $expected = 5079;

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
        $categoryId = 7325;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($categoryId)
            ->willReturn(null);

        $actual = $this->service->get($categoryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $categoryId = 9503;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($categoryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($categoryId);
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
        $categoryId = 8892;
        $expected = 1395;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($categoryId)
            ->willReturn($expected);

        $actual = $this->service->delete($categoryId);
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