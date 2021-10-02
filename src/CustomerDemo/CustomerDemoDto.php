<?php

declare(strict_types=1);

namespace Northwind\CustomerDemo;

class CustomerDemoDto 
{
    public int $customerDemoId;
    public int $customerId;
    public int $customerTypeId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customerDemoId = (int) ($row["customer_demo_id"] ?? 0);
        $this->customerId = (int) ($row["customer_id"] ?? 0);
        $this->customerTypeId = (int) ($row["customer_type_id"] ?? 0);
    }
}