<?php

declare(strict_types=1);

namespace Northwind\Products;

class ProductsDto 
{
    public int $productId;
    public string $productName;
    public int $supplierId;
    public int $categoryId;
    public string $quantityPerUnit;
    public float $unitPrice;
    public int $unitsInStock;
    public int $unitsOnOrder;
    public int $reorderLevel;
    public string $discontinued;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->productId = (int) ($row["product_id"] ?? 0);
        $this->productName = $row["product_name"] ?? "";
        $this->supplierId = (int) ($row["supplier_id"] ?? 0);
        $this->categoryId = (int) ($row["category_id"] ?? 0);
        $this->quantityPerUnit = $row["quantity_per_unit"] ?? "";
        $this->unitPrice = (float) ($row["unit_price"] ?? 0);
        $this->unitsInStock = (int) ($row["units_in_stock"] ?? 0);
        $this->unitsOnOrder = (int) ($row["units_on_order"] ?? 0);
        $this->reorderLevel = (int) ($row["reorder_level"] ?? 0);
        $this->discontinued = $row["discontinued"] ?? "";
    }
}