<?php

declare(strict_types=1);

namespace Northwind\Tests\Territories;

use PHPUnit\Framework\TestCase;
use Northwind\Territories\{ TerritoriesDto, TerritoriesModel };

class TerritoriesModelTest extends TestCase
{
    private array $input;
    private TerritoriesDto $dto;
    private TerritoriesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "territory_id" => 2,
            "territory_description" => 5499,
            "region_id" => 6025,
        ];
        $this->dto = new TerritoriesDto($this->input);
        $this->model = new TerritoriesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new TerritoriesModel(null);

        $this->assertInstanceOf(TerritoriesModel::class, $model);
    }

    public function testGetTerritoryId(): void
    {
        $this->assertEquals($this->dto->territoryId, $this->model->getTerritoryId());
    }

    public function testSetTerritoryId(): void
    {
        $expected = 5104;
        $model = $this->model;
        $model->setTerritoryId($expected);

        $this->assertEquals($expected, $model->getTerritoryId());
    }

    public function testGetTerritoryDescription(): void
    {
        $this->assertEquals($this->dto->territoryDescription, $this->model->getTerritoryDescription());
    }

    public function testSetTerritoryDescription(): void
    {
        $expected = 1450;
        $model = $this->model;
        $model->setTerritoryDescription($expected);

        $this->assertEquals($expected, $model->getTerritoryDescription());
    }

    public function testGetRegionId(): void
    {
        $this->assertEquals($this->dto->regionId, $this->model->getRegionId());
    }

    public function testSetRegionId(): void
    {
        $expected = 7943;
        $model = $this->model;
        $model->setRegionId($expected);

        $this->assertEquals($expected, $model->getRegionId());
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