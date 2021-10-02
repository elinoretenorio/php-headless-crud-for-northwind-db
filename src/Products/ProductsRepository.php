<?php

declare(strict_types=1);

namespace Northwind\Products;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class ProductsRepository implements IProductsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ProductsDto $dto): int
    {
        $sql = "INSERT INTO `products` (`product_name`, `supplier_id`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `reorder_level`, `discontinued`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->productName,
                $dto->supplierId,
                $dto->categoryId,
                $dto->quantityPerUnit,
                $dto->unitPrice,
                $dto->unitsInStock,
                $dto->unitsOnOrder,
                $dto->reorderLevel,
                $dto->discontinued
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ProductsDto $dto): int
    {
        $sql = "UPDATE `products` SET `product_name` = ?, `supplier_id` = ?, `category_id` = ?, `quantity_per_unit` = ?, `unit_price` = ?, `units_in_stock` = ?, `units_on_order` = ?, `reorder_level` = ?, `discontinued` = ?
                WHERE `product_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->productName,
                $dto->supplierId,
                $dto->categoryId,
                $dto->quantityPerUnit,
                $dto->unitPrice,
                $dto->unitsInStock,
                $dto->unitsOnOrder,
                $dto->reorderLevel,
                $dto->discontinued,
                $dto->productId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $productId): ?ProductsDto
    {
        $sql = "SELECT `product_id`, `product_name`, `supplier_id`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `reorder_level`, `discontinued`
                FROM `products` WHERE `product_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ProductsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `product_id`, `product_name`, `supplier_id`, `category_id`, `quantity_per_unit`, `unit_price`, `units_in_stock`, `units_on_order`, `reorder_level`, `discontinued`
                FROM `products`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ProductsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $productId): int
    {
        $sql = "DELETE FROM `products` WHERE `product_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}