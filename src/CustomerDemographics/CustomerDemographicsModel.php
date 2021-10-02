<?php

declare(strict_types=1);

namespace Northwind\CustomerDemographics;

use JsonSerializable;

class CustomerDemographicsModel implements JsonSerializable
{
    private int $customerDemographicsId;
    private int $customerTypeId;
    private string $customerDesc;

    public function __construct(CustomerDemographicsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customerDemographicsId = $dto->customerDemographicsId;
        $this->customerTypeId = $dto->customerTypeId;
        $this->customerDesc = $dto->customerDesc;
    }

    public function getCustomerDemographicsId(): int
    {
        return $this->customerDemographicsId;
    }

    public function setCustomerDemographicsId(int $customerDemographicsId): void
    {
        $this->customerDemographicsId = $customerDemographicsId;
    }

    public function getCustomerTypeId(): int
    {
        return $this->customerTypeId;
    }

    public function setCustomerTypeId(int $customerTypeId): void
    {
        $this->customerTypeId = $customerTypeId;
    }

    public function getCustomerDesc(): string
    {
        return $this->customerDesc;
    }

    public function setCustomerDesc(string $customerDesc): void
    {
        $this->customerDesc = $customerDesc;
    }

    public function toDto(): CustomerDemographicsDto
    {
        $dto = new CustomerDemographicsDto();
        $dto->customerDemographicsId = (int) ($this->customerDemographicsId ?? 0);
        $dto->customerTypeId = (int) ($this->customerTypeId ?? 0);
        $dto->customerDesc = $this->customerDesc ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "customer_demographics_id" => $this->customerDemographicsId,
            "customer_type_id" => $this->customerTypeId,
            "customer_desc" => $this->customerDesc,
        ];
    }
}