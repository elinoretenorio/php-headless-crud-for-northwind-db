<?php

declare(strict_types=1);

namespace Northwind\Employees;

class EmployeesDto 
{
    public int $employeeId;
    public string $lastName;
    public string $firstName;
    public string $title;
    public string $titleOfCourtesy;
    public string $birthDate;
    public string $hireDate;
    public string $address;
    public string $city;
    public string $region;
    public string $postalCode;
    public string $country;
    public string $homePhone;
    public string $extension;
    public string $photo;
    public string $notes;
    public int $reportsTo;
    public string $photoPath;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->employeeId = (int) ($row["employee_id"] ?? 0);
        $this->lastName = $row["last_name"] ?? "";
        $this->firstName = $row["first_name"] ?? "";
        $this->title = $row["title"] ?? "";
        $this->titleOfCourtesy = $row["title_of_courtesy"] ?? "";
        $this->birthDate = $row["birth_date"] ?? "";
        $this->hireDate = $row["hire_date"] ?? "";
        $this->address = $row["address"] ?? "";
        $this->city = $row["city"] ?? "";
        $this->region = $row["region"] ?? "";
        $this->postalCode = $row["postal_code"] ?? "";
        $this->country = $row["country"] ?? "";
        $this->homePhone = $row["home_phone"] ?? "";
        $this->extension = $row["extension"] ?? "";
        $this->photo = $row["photo"] ?? "";
        $this->notes = $row["notes"] ?? "";
        $this->reportsTo = (int) ($row["reports_to"] ?? 0);
        $this->photoPath = $row["photo_path"] ?? "";
    }
}