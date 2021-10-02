<?php

declare(strict_types=1);

namespace Northwind\Products;

use JsonSerializable;

class ProductsModel implements JsonSerializable
{
    private int $productId;
    private string $productName;
    private int $supplierId;
    private int $categoryId;
    private string $quantityPerUnit;
    private float $unitPrice;
    private int $unitsInStock;
    private int $unitsOnOrder;
    private int $reorderLevel;
    private string $discontinued;

    public function __construct(ProductsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->productId = $dto->productId;
        $this->productName = $dto->productName;
        $this->supplierId = $dto->supplierId;
        $this->categoryId = $dto->categoryId;
        $this->quantityPerUnit = $dto->quantityPerUnit;
        $this->unitPrice = $dto->unitPrice;
        $this->unitsInStock = $dto->unitsInStock;
        $this->unitsOnOrder = $dto->unitsOnOrder;
        $this->reorderLevel = $dto->reorderLevel;
        $this->discontinued = $dto->discontinued;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $supplierId): void
    {
        $this->supplierId = $supplierId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getQuantityPerUnit(): string
    {
        return $this->quantityPerUnit;
    }

    public function setQuantityPerUnit(string $quantityPerUnit): void
    {
        $this->quantityPerUnit = $quantityPerUnit;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getUnitsInStock(): int
    {
        return $this->unitsInStock;
    }

    public function setUnitsInStock(int $unitsInStock): void
    {
        $this->unitsInStock = $unitsInStock;
    }

    public function getUnitsOnOrder(): int
    {
        return $this->unitsOnOrder;
    }

    public function setUnitsOnOrder(int $unitsOnOrder): void
    {
        $this->unitsOnOrder = $unitsOnOrder;
    }

    public function getReorderLevel(): int
    {
        return $this->reorderLevel;
    }

    public function setReorderLevel(int $reorderLevel): void
    {
        $this->reorderLevel = $reorderLevel;
    }

    public function getDiscontinued(): string
    {
        return $this->discontinued;
    }

    public function setDiscontinued(string $discontinued): void
    {
        $this->discontinued = $discontinued;
    }

    public function toDto(): ProductsDto
    {
        $dto = new ProductsDto();
        $dto->productId = (int) ($this->productId ?? 0);
        $dto->productName = $this->productName ?? "";
        $dto->supplierId = (int) ($this->supplierId ?? 0);
        $dto->categoryId = (int) ($this->categoryId ?? 0);
        $dto->quantityPerUnit = $this->quantityPerUnit ?? "";
        $dto->unitPrice = (float) ($this->unitPrice ?? 0);
        $dto->unitsInStock = (int) ($this->unitsInStock ?? 0);
        $dto->unitsOnOrder = (int) ($this->unitsOnOrder ?? 0);
        $dto->reorderLevel = (int) ($this->reorderLevel ?? 0);
        $dto->discontinued = $this->discontinued ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "product_id" => $this->productId,
            "product_name" => $this->productName,
            "supplier_id" => $this->supplierId,
            "category_id" => $this->categoryId,
            "quantity_per_unit" => $this->quantityPerUnit,
            "unit_price" => $this->unitPrice,
            "units_in_stock" => $this->unitsInStock,
            "units_on_order" => $this->unitsOnOrder,
            "reorder_level" => $this->reorderLevel,
            "discontinued" => $this->discontinued,
        ];
    }
}