<?php

declare(strict_types=1);

namespace Northwind\Tests\EmployeeTerritories;

use PHPUnit\Framework\TestCase;
use Northwind\EmployeeTerritories\{ EmployeeTerritoriesDto, EmployeeTerritoriesModel };

class EmployeeTerritoriesModelTest extends TestCase
{
    private array $input;
    private EmployeeTerritoriesDto $dto;
    private EmployeeTerritoriesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "employee_territories_id" => 8399,
            "employee_id" => 4909,
            "territory_id" => "Fly already government structure walk card indicate cup.",
        ];
        $this->dto = new EmployeeTerritoriesDto($this->input);
        $this->model = new EmployeeTerritoriesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new EmployeeTerritoriesModel(null);

        $this->assertInstanceOf(EmployeeTerritoriesModel::class, $model);
    }

    public function testGetEmployeeTerritoriesId(): void
    {
        $this->assertEquals($this->dto->employeeTerritoriesId, $this->model->getEmployeeTerritoriesId());
    }

    public function testSetEmployeeTerritoriesId(): void
    {
        $expected = 7527;
        $model = $this->model;
        $model->setEmployeeTerritoriesId($expected);

        $this->assertEquals($expected, $model->getEmployeeTerritoriesId());
    }

    public function testGetEmployeeId(): void
    {
        $this->assertEquals($this->dto->employeeId, $this->model->getEmployeeId());
    }

    public function testSetEmployeeId(): void
    {
        $expected = 6280;
        $model = $this->model;
        $model->setEmployeeId($expected);

        $this->assertEquals($expected, $model->getEmployeeId());
    }

    public function testGetTerritoryId(): void
    {
        $this->assertEquals($this->dto->territoryId, $this->model->getTerritoryId());
    }

    public function testSetTerritoryId(): void
    {
        $expected = "Admit bed modern upon approach.";
        $model = $this->model;
        $model->setTerritoryId($expected);

        $this->assertEquals($expected, $model->getTerritoryId());
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