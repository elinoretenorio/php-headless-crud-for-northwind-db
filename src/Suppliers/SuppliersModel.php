<?php

declare(strict_types=1);

namespace Northwind\Suppliers;

use JsonSerializable;

class SuppliersModel implements JsonSerializable
{
    private int $supplierId;
    private string $companyName;
    private string $contactName;
    private string $contactTitle;
    private string $address;
    private string $city;
    private string $region;
    private string $postalCode;
    private string $country;
    private string $phone;
    private string $fax;
    private string $homepage;

    public function __construct(SuppliersDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->supplierId = $dto->supplierId;
        $this->companyName = $dto->companyName;
        $this->contactName = $dto->contactName;
        $this->contactTitle = $dto->contactTitle;
        $this->address = $dto->address;
        $this->city = $dto->city;
        $this->region = $dto->region;
        $this->postalCode = $dto->postalCode;
        $this->country = $dto->country;
        $this->phone = $dto->phone;
        $this->fax = $dto->fax;
        $this->homepage = $dto->homepage;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $supplierId): void
    {
        $this->supplierId = $supplierId;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getContactName(): string
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName): void
    {
        $this->contactName = $contactName;
    }

    public function getContactTitle(): string
    {
        return $this->contactTitle;
    }

    public function setContactTitle(string $contactTitle): void
    {
        $this->contactTitle = $contactTitle;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getFax(): string
    {
        return $this->fax;
    }

    public function setFax(string $fax): void
    {
        $this->fax = $fax;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    public function toDto(): SuppliersDto
    {
        $dto = new SuppliersDto();
        $dto->supplierId = (int) ($this->supplierId ?? 0);
        $dto->companyName = $this->companyName ?? "";
        $dto->contactName = $this->contactName ?? "";
        $dto->contactTitle = $this->contactTitle ?? "";
        $dto->address = $this->address ?? "";
        $dto->city = $this->city ?? "";
        $dto->region = $this->region ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->country = $this->country ?? "";
        $dto->phone = $this->phone ?? "";
        $dto->fax = $this->fax ?? "";
        $dto->homepage = $this->homepage ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "supplier_id" => $this->supplierId,
            "company_name" => $this->companyName,
            "contact_name" => $this->contactName,
            "contact_title" => $this->contactTitle,
            "address" => $this->address,
            "city" => $this->city,
            "region" => $this->region,
            "postal_code" => $this->postalCode,
            "country" => $this->country,
            "phone" => $this->phone,
            "fax" => $this->fax,
            "homepage" => $this->homepage,
        ];
    }
}