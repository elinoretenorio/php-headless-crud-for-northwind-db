<?php

declare(strict_types=1);

namespace Northwind\Tests\UsStates;

use PHPUnit\Framework\TestCase;
use Northwind\UsStates\{ UsStatesDto, UsStatesModel };

class UsStatesModelTest extends TestCase
{
    private array $input;
    private UsStatesDto $dto;
    private UsStatesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "state_id" => 9627,
            "state_name" => "lot",
            "state_abbr" => "case",
            "state_region" => "eight",
        ];
        $this->dto = new UsStatesDto($this->input);
        $this->model = new UsStatesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new UsStatesModel(null);

        $this->assertInstanceOf(UsStatesModel::class, $model);
    }

    public function testGetStateId(): void
    {
        $this->assertEquals($this->dto->stateId, $this->model->getStateId());
    }

    public function testSetStateId(): void
    {
        $expected = 3477;
        $model = $this->model;
        $model->setStateId($expected);

        $this->assertEquals($expected, $model->getStateId());
    }

    public function testGetStateName(): void
    {
        $this->assertEquals($this->dto->stateName, $this->model->getStateName());
    }

    public function testSetStateName(): void
    {
        $expected = "its";
        $model = $this->model;
        $model->setStateName($expected);

        $this->assertEquals($expected, $model->getStateName());
    }

    public function testGetStateAbbr(): void
    {
        $this->assertEquals($this->dto->stateAbbr, $this->model->getStateAbbr());
    }

    public function testSetStateAbbr(): void
    {
        $expected = "mouth";
        $model = $this->model;
        $model->setStateAbbr($expected);

        $this->assertEquals($expected, $model->getStateAbbr());
    }

    public function testGetStateRegion(): void
    {
        $this->assertEquals($this->dto->stateRegion, $this->model->getStateRegion());
    }

    public function testSetStateRegion(): void
    {
        $expected = "meeting";
        $model = $this->model;
        $model->setStateRegion($expected);

        $this->assertEquals($expected, $model->getStateRegion());
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