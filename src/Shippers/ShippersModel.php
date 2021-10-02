<?php

declare(strict_types=1);

namespace Northwind\Shippers;

use JsonSerializable;

class ShippersModel implements JsonSerializable
{
    private int $shipperId;
    private string $companyName;
    private string $phone;

    public function __construct(ShippersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->shipperId = $dto->shipperId;
        $this->companyName = $dto->companyName;
        $this->phone = $dto->phone;
    }

    public function getShipperId(): int
    {
        return $this->shipperId;
    }

    public function setShipperId(int $shipperId): void
    {
        $this->shipperId = $shipperId;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function toDto(): ShippersDto
    {
        $dto = new ShippersDto();
        $dto->shipperId = (int) ($this->shipperId ?? 0);
        $dto->companyName = $this->companyName ?? "";
        $dto->phone = $this->phone ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "shipper_id" => $this->shipperId,
            "company_name" => $this->companyName,
            "phone" => $this->phone,
        ];
    }
}