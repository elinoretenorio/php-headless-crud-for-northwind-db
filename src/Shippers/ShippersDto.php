<?php

declare(strict_types=1);

namespace Northwind\Shippers;

class ShippersDto 
{
    public int $shipperId;
    public string $companyName;
    public string $phone;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->shipperId = (int) ($row["shipper_id"] ?? 0);
        $this->companyName = $row["company_name"] ?? "";
        $this->phone = $row["phone"] ?? "";
    }
}