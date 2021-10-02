<?php

declare(strict_types=1);

namespace Northwind\Orders;

class OrdersDto 
{
    public int $orderId;
    public int $customerId;
    public int $employeeId;
    public string $orderDate;
    public string $requiredDate;
    public string $shippedDate;
    public int $shipVia;
    public float $freight;
    public string $shipName;
    public string $shipAddress;
    public string $shipCity;
    public string $shipRegion;
    public string $shipPostalCode;
    public string $shipCountry;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->orderId = (int) ($row["order_id"] ?? 0);
        $this->customerId = (int) ($row["customer_id"] ?? 0);
        $this->employeeId = (int) ($row["employee_id"] ?? 0);
        $this->orderDate = $row["order_date"] ?? "";
        $this->requiredDate = $row["required_date"] ?? "";
        $this->shippedDate = $row["shipped_date"] ?? "";
        $this->shipVia = (int) ($row["ship_via"] ?? 0);
        $this->freight = (float) ($row["freight"] ?? 0);
        $this->shipName = $row["ship_name"] ?? "";
        $this->shipAddress = $row["ship_address"] ?? "";
        $this->shipCity = $row["ship_city"] ?? "";
        $this->shipRegion = $row["ship_region"] ?? "";
        $this->shipPostalCode = $row["ship_postal_code"] ?? "";
        $this->shipCountry = $row["ship_country"] ?? "";
    }
}