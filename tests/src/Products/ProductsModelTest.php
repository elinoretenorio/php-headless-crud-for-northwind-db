<?php

declare(strict_types=1);

namespace Northwind\Tests\Products;

use PHPUnit\Framework\TestCase;
use Northwind\Products\{ ProductsDto, ProductsModel };

class ProductsModelTest extends TestCase
{
    private array $input;
    private ProductsDto $dto;
    private ProductsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "product_id" => 5282,
            "product_name" => "hand",
            "supplier_id" => 2796,
            "category_id" => 1426,
            "quantity_per_unit" => "collection",
            "unit_price" => 730.00,
            "units_in_stock" => 1961,
            "units_on_order" => 4672,
            "reorder_level" => 6183,
            "discontinued" => "Ahead born so gas.",
        ];
        $this->dto = new ProductsDto($this->input);
        $this->model = new ProductsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ProductsModel(null);

        $this->assertInstanceOf(ProductsModel::class, $model);
    }

    public function testGetProductId(): void
    {
        $this->assertEquals($this->dto->productId, $this->model->getProductId());
    }

    public function testSetProductId(): void
    {
        $expected = 9182;
        $model = $this->model;
        $model->setProductId($expected);

        $this->assertEquals($expected, $model->getProductId());
    }

    public function testGetProductName(): void
    {
        $this->assertEquals($this->dto->productName, $this->model->getProductName());
    }

    public function testSetProductName(): void
    {
        $expected = "until";
        $model = $this->model;
        $model->setProductName($expected);

        $this->assertEquals($expected, $model->getProductName());
    }

    public function testGetSupplierId(): void
    {
        $this->assertEquals($this->dto->supplierId, $this->model->getSupplierId());
    }

    public function testSetSupplierId(): void
    {
        $expected = 6914;
        $model = $this->model;
        $model->setSupplierId($expected);

        $this->assertEquals($expected, $model->getSupplierId());
    }

    public function testGetCategoryId(): void
    {
        $this->assertEquals($this->dto->categoryId, $this->model->getCategoryId());
    }

    public function testSetCategoryId(): void
    {
        $expected = 8914;
        $model = $this->model;
        $model->setCategoryId($expected);

        $this->assertEquals($expected, $model->getCategoryId());
    }

    public function testGetQuantityPerUnit(): void
    {
        $this->assertEquals($this->dto->quantityPerUnit, $this->model->getQuantityPerUnit());
    }

    public function testSetQuantityPerUnit(): void
    {
        $expected = "participant";
        $model = $this->model;
        $model->setQuantityPerUnit($expected);

        $this->assertEquals($expected, $model->getQuantityPerUnit());
    }

    public function testGetUnitPrice(): void
    {
        $this->assertEquals($this->dto->unitPrice, $this->model->getUnitPrice());
    }

    public function testSetUnitPrice(): void
    {
        $expected = 288.70;
        $model = $this->model;
        $model->setUnitPrice($expected);

        $this->assertEquals($expected, $model->getUnitPrice());
    }

    public function testGetUnitsInStock(): void
    {
        $this->assertEquals($this->dto->unitsInStock, $this->model->getUnitsInStock());
    }

    public function testSetUnitsInStock(): void
    {
        $expected = 7536;
        $model = $this->model;
        $model->setUnitsInStock($expected);

        $this->assertEquals($expected, $model->getUnitsInStock());
    }

    public function testGetUnitsOnOrder(): void
    {
        $this->assertEquals($this->dto->unitsOnOrder, $this->model->getUnitsOnOrder());
    }

    public function testSetUnitsOnOrder(): void
    {
        $expected = 3156;
        $model = $this->model;
        $model->setUnitsOnOrder($expected);

        $this->assertEquals($expected, $model->getUnitsOnOrder());
    }

    public function testGetReorderLevel(): void
    {
        $this->assertEquals($this->dto->reorderLevel, $this->model->getReorderLevel());
    }

    public function testSetReorderLevel(): void
    {
        $expected = 1419;
        $model = $this->model;
        $model->setReorderLevel($expected);

        $this->assertEquals($expected, $model->getReorderLevel());
    }

    public function testGetDiscontinued(): void
    {
        $this->assertEquals($this->dto->discontinued, $this->model->getDiscontinued());
    }

    public function testSetDiscontinued(): void
    {
        $expected = "Suffer suffer break morning.";
        $model = $this->model;
        $model->setDiscontinued($expected);

        $this->assertEquals($expected, $model->getDiscontinued());
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