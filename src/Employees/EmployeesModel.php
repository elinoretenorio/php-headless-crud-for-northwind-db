<?php

declare(strict_types=1);

namespace Northwind\Employees;

use JsonSerializable;

class EmployeesModel implements JsonSerializable
{
    private int $employeeId;
    private string $lastName;
    private string $firstName;
    private string $title;
    private string $titleOfCourtesy;
    private string $birthDate;
    private string $hireDate;
    private string $address;
    private string $city;
    private string $region;
    private string $postalCode;
    private string $country;
    private string $homePhone;
    private string $extension;
    private string $photo;
    private string $notes;
    private int $reportsTo;
    private string $photoPath;

    public function __construct(EmployeesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->employeeId = $dto->employeeId;
        $this->lastName = $dto->lastName;
        $this->firstName = $dto->firstName;
        $this->title = $dto->title;
        $this->titleOfCourtesy = $dto->titleOfCourtesy;
        $this->birthDate = $dto->birthDate;
        $this->hireDate = $dto->hireDate;
        $this->address = $dto->address;
        $this->city = $dto->city;
        $this->region = $dto->region;
        $this->postalCode = $dto->postalCode;
        $this->country = $dto->country;
        $this->homePhone = $dto->homePhone;
        $this->extension = $dto->extension;
        $this->photo = $dto->photo;
        $this->notes = $dto->notes;
        $this->reportsTo = $dto->reportsTo;
        $this->photoPath = $dto->photoPath;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitleOfCourtesy(): string
    {
        return $this->titleOfCourtesy;
    }

    public function setTitleOfCourtesy(string $titleOfCourtesy): void
    {
        $this->titleOfCourtesy = $titleOfCourtesy;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function getHireDate(): string
    {
        return $this->hireDate;
    }

    public function setHireDate(string $hireDate): void
    {
        $this->hireDate = $hireDate;
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

    public function getHomePhone(): string
    {
        return $this->homePhone;
    }

    public function setHomePhone(string $homePhone): void
    {
        $this->homePhone = $homePhone;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    public function getReportsTo(): int
    {
        return $this->reportsTo;
    }

    public function setReportsTo(int $reportsTo): void
    {
        $this->reportsTo = $reportsTo;
    }

    public function getPhotoPath(): string
    {
        return $this->photoPath;
    }

    public function setPhotoPath(string $photoPath): void
    {
        $this->photoPath = $photoPath;
    }

    public function toDto(): EmployeesDto
    {
        $dto = new EmployeesDto();
        $dto->employeeId = (int) ($this->employeeId ?? 0);
        $dto->lastName = $this->lastName ?? "";
        $dto->firstName = $this->firstName ?? "";
        $dto->title = $this->title ?? "";
        $dto->titleOfCourtesy = $this->titleOfCourtesy ?? "";
        $dto->birthDate = $this->birthDate ?? "";
        $dto->hireDate = $this->hireDate ?? "";
        $dto->address = $this->address ?? "";
        $dto->city = $this->city ?? "";
        $dto->region = $this->region ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->country = $this->country ?? "";
        $dto->homePhone = $this->homePhone ?? "";
        $dto->extension = $this->extension ?? "";
        $dto->photo = $this->photo ?? "";
        $dto->notes = $this->notes ?? "";
        $dto->reportsTo = (int) ($this->reportsTo ?? 0);
        $dto->photoPath = $this->photoPath ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "employee_id" => $this->employeeId,
            "last_name" => $this->lastName,
            "first_name" => $this->firstName,
            "title" => $this->title,
            "title_of_courtesy" => $this->titleOfCourtesy,
            "birth_date" => $this->birthDate,
            "hire_date" => $this->hireDate,
            "address" => $this->address,
            "city" => $this->city,
            "region" => $this->region,
            "postal_code" => $this->postalCode,
            "country" => $this->country,
            "home_phone" => $this->homePhone,
            "extension" => $this->extension,
            "photo" => $this->photo,
            "notes" => $this->notes,
            "reports_to" => $this->reportsTo,
            "photo_path" => $this->photoPath,
        ];
    }
}