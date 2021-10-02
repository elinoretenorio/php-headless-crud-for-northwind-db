<?php

declare(strict_types=1);

namespace Northwind\Customers;

class CustomersDto 
{
    public int $customerId;
    public string $companyName;
    public string $contactName;
    public string $contactTitle;
    public string $address;
    public string $city;
    public string $region;
    public string $postalCode;
    public string $country;
    public string $phone;
    public string $fax;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->customerId = (int) ($row["customer_id"] ?? 0);
        $this->companyName = $row["company_name"] ?? "";
        $this->contactName = $row["contact_name"] ?? "";
        $this->contactTitle = $row["contact_title"] ?? "";
        $this->address = $row["address"] ?? "";
        $this->city = $row["city"] ?? "";
        $this->region = $row["region"] ?? "";
        $this->postalCode = $row["postal_code"] ?? "";
        $this->country = $row["country"] ?? "";
        $this->phone = $row["phone"] ?? "";
        $this->fax = $row["fax"] ?? "";
    }
}