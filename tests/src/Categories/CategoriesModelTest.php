<?php

declare(strict_types=1);

namespace Northwind\Tests\Categories;

use PHPUnit\Framework\TestCase;
use Northwind\Categories\{ CategoriesDto, CategoriesModel };

class CategoriesModelTest extends TestCase
{
    private array $input;
    private CategoriesDto $dto;
    private CategoriesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "category_id" => 821,
            "category_name" => "plan",
            "description" => "Father hand collection hold.",
            "picture" => "Other ball clearly everybody point.",
        ];
        $this->dto = new CategoriesDto($this->input);
        $this->model = new CategoriesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CategoriesModel(null);

        $this->assertInstanceOf(CategoriesModel::class, $model);
    }

    public function testGetCategoryId(): void
    {
        $this->assertEquals($this->dto->categoryId, $this->model->getCategoryId());
    }

    public function testSetCategoryId(): void
    {
        $expected = 746;
        $model = $this->model;
        $model->setCategoryId($expected);

        $this->assertEquals($expected, $model->getCategoryId());
    }

    public function testGetCategoryName(): void
    {
        $this->assertEquals($this->dto->categoryName, $this->model->getCategoryName());
    }

    public function testSetCategoryName(): void
    {
        $expected = "attack";
        $model = $this->model;
        $model->setCategoryName($expected);

        $this->assertEquals($expected, $model->getCategoryName());
    }

    public function testGetDescription(): void
    {
        $this->assertEquals($this->dto->description, $this->model->getDescription());
    }

    public function testSetDescription(): void
    {
        $expected = "Chance yes send story special prove. Us federal threat house floor. Moment game one ever walk several.";
        $model = $this->model;
        $model->setDescription($expected);

        $this->assertEquals($expected, $model->getDescription());
    }

    public function testGetPicture(): void
    {
        $this->assertEquals($this->dto->picture, $this->model->getPicture());
    }

    public function testSetPicture(): void
    {
        $expected = "Food relate defense admit practice.";
        $model = $this->model;
        $model->setPicture($expected);

        $this->assertEquals($expected, $model->getPicture());
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