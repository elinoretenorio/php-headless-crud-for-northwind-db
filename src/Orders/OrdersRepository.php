<?php

declare(strict_types=1);

namespace Northwind\Orders;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class OrdersRepository implements IOrdersRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(OrdersDto $dto): int
    {
        $sql = "INSERT INTO `orders` (`customer_id`, `employee_id`, `order_date`, `required_date`, `shipped_date`, `ship_via`, `freight`, `ship_name`, `ship_address`, `ship_city`, `ship_region`, `ship_postal_code`, `ship_country`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->employeeId,
                $dto->orderDate,
                $dto->requiredDate,
                $dto->shippedDate,
                $dto->shipVia,
                $dto->freight,
                $dto->shipName,
                $dto->shipAddress,
                $dto->shipCity,
                $dto->shipRegion,
                $dto->shipPostalCode,
                $dto->shipCountry
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(OrdersDto $dto): int
    {
        $sql = "UPDATE `orders` SET `customer_id` = ?, `employee_id` = ?, `order_date` = ?, `required_date` = ?, `shipped_date` = ?, `ship_via` = ?, `freight` = ?, `ship_name` = ?, `ship_address` = ?, `ship_city` = ?, `ship_region` = ?, `ship_postal_code` = ?, `ship_country` = ?
                WHERE `order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->customerId,
                $dto->employeeId,
                $dto->orderDate,
                $dto->requiredDate,
                $dto->shippedDate,
                $dto->shipVia,
                $dto->freight,
                $dto->shipName,
                $dto->shipAddress,
                $dto->shipCity,
                $dto->shipRegion,
                $dto->shipPostalCode,
                $dto->shipCountry,
                $dto->orderId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $orderId): ?OrdersDto
    {
        $sql = "SELECT `order_id`, `customer_id`, `employee_id`, `order_date`, `required_date`, `shipped_date`, `ship_via`, `freight`, `ship_name`, `ship_address`, `ship_city`, `ship_region`, `ship_postal_code`, `ship_country`
                FROM `orders` WHERE `order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new OrdersDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `order_id`, `customer_id`, `employee_id`, `order_date`, `required_date`, `shipped_date`, `ship_via`, `freight`, `ship_name`, `ship_address`, `ship_city`, `ship_region`, `ship_postal_code`, `ship_country`
                FROM `orders`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new OrdersDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $orderId): int
    {
        $sql = "DELETE FROM `orders` WHERE `order_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$orderId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}