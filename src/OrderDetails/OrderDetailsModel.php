<?php

declare(strict_types=1);

namespace Northwind\OrderDetails;

use JsonSerializable;

class OrderDetailsModel implements JsonSerializable
{
    private int $orderDetailsId;
    private int $orderId;
    private int $productId;
    private float $unitPrice;
    private int $quantity;
    private float $discount;

    public function __construct(OrderDetailsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->orderDetailsId = $dto->orderDetailsId;
        $this->orderId = $dto->orderId;
        $this->productId = $dto->productId;
        $this->unitPrice = $dto->unitPrice;
        $this->quantity = $dto->quantity;
        $this->discount = $dto->discount;
    }

    public function getOrderDetailsId(): int
    {
        return $this->orderDetailsId;
    }

    public function setOrderDetailsId(int $orderDetailsId): void
    {
        $this->orderDetailsId = $orderDetailsId;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    public function toDto(): OrderDetailsDto
    {
        $dto = new OrderDetailsDto();
        $dto->orderDetailsId = (int) ($this->orderDetailsId ?? 0);
        $dto->orderId = (int) ($this->orderId ?? 0);
        $dto->productId = (int) ($this->productId ?? 0);
        $dto->unitPrice = (float) ($this->unitPrice ?? 0);
        $dto->quantity = (int) ($this->quantity ?? 0);
        $dto->discount = (float) ($this->discount ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "order_details_id" => $this->orderDetailsId,
            "order_id" => $this->orderId,
            "product_id" => $this->productId,
            "unit_price" => $this->unitPrice,
            "quantity" => $this->quantity,
            "discount" => $this->discount,
        ];
    }
}