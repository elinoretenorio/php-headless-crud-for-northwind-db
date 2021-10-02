<?php

declare(strict_types=1);

namespace Northwind\CustomerDemo;

use JsonSerializable;

class CustomerDemoModel implements JsonSerializable
{
    private int $customerDemoId;
    private int $customerId;
    private int $customerTypeId;

    public function __construct(CustomerDemoDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->customerDemoId = $dto->customerDemoId;
        $this->customerId = $dto->customerId;
        $this->customerTypeId = $dto->customerTypeId;
    }

    public function getCustomerDemoId(): int
    {
        return $this->customerDemoId;
    }

    public function setCustomerDemoId(int $customerDemoId): void
    {
        $this->customerDemoId = $customerDemoId;
    }

    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getCustomerTypeId(): int
    {
        return $this->customerTypeId;
    }

    public function setCustomerTypeId(int $customerTypeId): void
    {
        $this->customerTypeId = $customerTypeId;
    }

    public function toDto(): CustomerDemoDto
    {
        $dto = new CustomerDemoDto();
        $dto->customerDemoId = (int) ($this->customerDemoId ?? 0);
        $dto->customerId = (int) ($this->customerId ?? 0);
        $dto->customerTypeId = (int) ($this->customerTypeId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "customer_demo_id" => $this->customerDemoId,
            "customer_id" => $this->customerId,
            "customer_type_id" => $this->customerTypeId,
        ];
    }
}