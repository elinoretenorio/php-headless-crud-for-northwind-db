<?php

declare(strict_types=1);

namespace Northwind\OrderDetails;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class OrderDetailsRepository implements IOrderDetailsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(OrderDetailsDto $dto): int
    {
        $sql = "INSERT INTO `order_details` (`order_id`, `product_id`, `unit_price`, `quantity`, `discount`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->orderId,
                $dto->productId,
                $dto->unitPrice,
                $dto->quantity,
                $dto->discount
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(OrderDetailsDto $dto): int
    {
        $sql = "UPDATE `order_details` SET `order_id` = ?, `product_id` = ?, `unit_price` = ?, `quantity` = ?, `discount` = ?
                WHERE `order_details_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->orderId,
                $dto->productId,
                $dto->unitPrice,
                $dto->quantity,
                $dto->discount,
                $dto->orderDetailsId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $orderDetailsId): ?OrderDetailsDto
    {
        $sql = "SELECT `order_details_id`, `order_id`, `product_id`, `unit_price`, `quantity`, `discount`
                FROM `order_details` WHERE `order_details_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderDetailsId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new OrderDetailsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `order_details_id`, `order_id`, `product_id`, `unit_price`, `quantity`, `discount`
                FROM `order_details`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new OrderDetailsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $orderDetailsId): int
    {
        $sql = "DELETE FROM `order_details` WHERE `order_details_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderDetailsId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}