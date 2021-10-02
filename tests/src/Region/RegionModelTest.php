<?php

declare(strict_types=1);

namespace Northwind\Tests\Region;

use PHPUnit\Framework\TestCase;
use Northwind\Region\{ RegionDto, RegionModel };

class RegionModelTest extends TestCase
{
    private array $input;
    private RegionDto $dto;
    private RegionModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "region_id" => 9761,
            "region_description" => 8317,
        ];
        $this->dto = new RegionDto($this->input);
        $this->model = new RegionModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new RegionModel(null);

        $this->assertInstanceOf(RegionModel::class, $model);
    }

    public function testGetRegionId(): void
    {
        $this->assertEquals($this->dto->regionId, $this->model->getRegionId());
    }

    public function testSetRegionId(): void
    {
        $expected = 1304;
        $model = $this->model;
        $model->setRegionId($expected);

        $this->assertEquals($expected, $model->getRegionId());
    }

    public function testGetRegionDescription(): void
    {
        $this->assertEquals($this->dto->regionDescription, $this->model->getRegionDescription());
    }

    public function testSetRegionDescription(): void
    {
        $expected = 2855;
        $model = $this->model;
        $model->setRegionDescription($expected);

        $this->assertEquals($expected, $model->getRegionDescription());
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