<?php

declare(strict_types=1);

namespace Northwind\OrderDetails;

class OrderDetailsDto 
{
    public int $orderDetailsId;
    public int $orderId;
    public int $productId;
    public float $unitPrice;
    public int $quantity;
    public float $discount;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->orderDetailsId = (int) ($row["order_details_id"] ?? 0);
        $this->orderId = (int) ($row["order_id"] ?? 0);
        $this->productId = (int) ($row["product_id"] ?? 0);
        $this->unitPrice = (float) ($row["unit_price"] ?? 0);
        $this->quantity = (int) ($row["quantity"] ?? 0);
        $this->discount = (float) ($row["discount"] ?? 0);
    }
}