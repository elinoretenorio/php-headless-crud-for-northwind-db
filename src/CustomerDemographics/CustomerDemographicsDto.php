<?php

declare(strict_types=1);

namespace Northwind\CustomerDemographics;

class CustomerDemographicsDto 
{
    public int $customerDemographicsId;
    public int $customerTypeId;
    public string $customerDesc;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customerDemographicsId = (int) ($row["customer_demographics_id"] ?? 0);
        $this->customerTypeId = (int) ($row["customer_type_id"] ?? 0);
        $this->customerDesc = $row["customer_desc"] ?? "";
    }
}