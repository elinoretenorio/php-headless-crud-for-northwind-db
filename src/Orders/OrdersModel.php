<?php

declare(strict_types=1);

namespace Northwind\Orders;

use JsonSerializable;

class OrdersModel implements JsonSerializable
{
    private int $orderId;
    private int $customerId;
    private int $employeeId;
    private string $orderDate;
    private string $requiredDate;
    private string $shippedDate;
    private int $shipVia;
    private float $freight;
    private string $shipName;
    private string $shipAddress;
    private string $shipCity;
    private string $shipRegion;
    private string $shipPostalCode;
    private string $shipCountry;

    public function __construct(OrdersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->orderId = $dto->orderId;
        $this->customerId = $dto->customerId;
        $this->employeeId = $dto->employeeId;
        $this->orderDate = $dto->orderDate;
        $this->requiredDate = $dto->requiredDate;
        $this->shippedDate = $dto->shippedDate;
        $this->shipVia = $dto->shipVia;
        $this->freight = $dto->freight;
        $this->shipName = $dto->shipName;
        $this->shipAddress = $dto->shipAddress;
        $this->shipCity = $dto->shipCity;
        $this->shipRegion = $dto->shipRegion;
        $this->shipPostalCode = $dto->shipPostalCode;
        $this->shipCountry = $dto->shipCountry;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    public function getRequiredDate(): string
    {
        return $this->requiredDate;
    }

    public function setRequiredDate(string $requiredDate): void
    {
        $this->requiredDate = $requiredDate;
    }

    public function getShippedDate(): string
    {
        return $this->shippedDate;
    }

    public function setShippedDate(string $shippedDate): void
    {
        $this->shippedDate = $shippedDate;
    }

    public function getShipVia(): int
    {
        return $this->shipVia;
    }

    public function setShipVia(int $shipVia): void
    {
        $this->shipVia = $shipVia;
    }

    public function getFreight(): float
    {
        return $this->freight;
    }

    public function setFreight(float $freight): void
    {
        $this->freight = $freight;
    }

    public function getShipName(): string
    {
        return $this->shipName;
    }

    public function setShipName(string $shipName): void
    {
        $this->shipName = $shipName;
    }

    public function getShipAddress(): string
    {
        return $this->shipAddress;
    }

    public function setShipAddress(string $shipAddress): void
    {
        $this->shipAddress = $shipAddress;
    }

    public function getShipCity(): string
    {
        return $this->shipCity;
    }

    public function setShipCity(string $shipCity): void
    {
        $this->shipCity = $shipCity;
    }

    public function getShipRegion(): string
    {
        return $this->shipRegion;
    }

    public function setShipRegion(string $shipRegion): void
    {
        $this->shipRegion = $shipRegion;
    }

    public function getShipPostalCode(): string
    {
        return $this->shipPostalCode;
    }

    public function setShipPostalCode(string $shipPostalCode): void
    {
        $this->shipPostalCode = $shipPostalCode;
    }

    public function getShipCountry(): string
    {
        return $this->shipCountry;
    }

    public function setShipCountry(string $shipCountry): void
    {
        $this->shipCountry = $shipCountry;
    }

    public function toDto(): OrdersDto
    {
        $dto = new OrdersDto();
        $dto->orderId = (int) ($this->orderId ?? 0);
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->employeeId = (int) ($this->employeeId ?? 0);
        $dto->orderDate = $this->orderDate ?? "";
        $dto->requiredDate = $this->requiredDate ?? "";
        $dto->shippedDate = $this->shippedDate ?? "";
        $dto->shipVia = (int) ($this->shipVia ?? 0);
        $dto->freight = (float) ($this->freight ?? 0);
        $dto->shipName = $this->shipName ?? "";
        $dto->shipAddress = $this->shipAddress ?? "";
        $dto->shipCity = $this->shipCity ?? "";
        $dto->shipRegion = $this->shipRegion ?? "";
        $dto->shipPostalCode = $this->shipPostalCode ?? "";
        $dto->shipCountry = $this->shipCountry ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "order_id" => $this->orderId,
            "customer_id" => $this->customerId,
            "employee_id" => $this->employeeId,
            "order_date" => $this->orderDate,
            "required_date" => $this->requiredDate,
            "shipped_date" => $this->shippedDate,
            "ship_via" => $this->shipVia,
            "freight" => $this->freight,
            "ship_name" => $this->shipName,
            "ship_address" => $this->shipAddress,
            "ship_city" => $this->shipCity,
            "ship_region" => $this->shipRegion,
            "ship_postal_code" => $this->shipPostalCode,
            "ship_country" => $this->shipCountry,
        ];
    }
}