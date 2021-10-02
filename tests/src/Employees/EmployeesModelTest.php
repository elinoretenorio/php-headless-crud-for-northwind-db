<?php

declare(strict_types=1);

namespace Northwind\Tests\Employees;

use PHPUnit\Framework\TestCase;
use Northwind\Employees\{ EmployeesDto, EmployeesModel };

class EmployeesModelTest extends TestCase
{
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "employee_id" => 2204,
            "last_name" => "over",
            "first_name" => "third",
            "title" => "before",
            "title_of_courtesy" => "sister",
            "birth_date" => "2021-10-11",
            "hire_date" => "2021-09-28",
            "address" => "majority",
            "city" => "everyone",
            "region" => "national",
            "postal_code" => "quite",
            "country" => "language",
            "home_phone" => "pay",
            "extension" => "music",
            "photo" => "Risk help Republican real age.",
            "notes" => "Long drug line history into list commercial. State speech magazine community billion us rise.",
            "reports_to" => 1029,
            "photo_path" => "but",
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new EmployeesModel(null);

        $this->assertInstanceOf(EmployeesModel::class, $model);
    }

    public function testGetEmployeeId(): void
    {
        $this->assertEquals($this->dto->employeeId, $this->model->getEmployeeId());
    }

    public function testSetEmployeeId(): void
    {
        $expected = 4260;
        $model = $this->model;
        $model->setEmployeeId($expected);

        $this->assertEquals($expected, $model->getEmployeeId());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "conference";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "us";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetTitle(): void
    {
        $this->assertEquals($this->dto->title, $this->model->getTitle());
    }

    public function testSetTitle(): void
    {
        $expected = "care";
        $model = $this->model;
        $model->setTitle($expected);

        $this->assertEquals($expected, $model->getTitle());
    }

    public function testGetTitleOfCourtesy(): void
    {
        $this->assertEquals($this->dto->titleOfCourtesy, $this->model->getTitleOfCourtesy());
    }

    public function testSetTitleOfCourtesy(): void
    {
        $expected = "evidence";
        $model = $this->model;
        $model->setTitleOfCourtesy($expected);

        $this->assertEquals($expected, $model->getTitleOfCourtesy());
    }

    public function testGetBirthDate(): void
    {
        $this->assertEquals($this->dto->birthDate, $this->model->getBirthDate());
    }

    public function testSetBirthDate(): void
    {
        $expected = "2021-10-01";
        $model = $this->model;
        $model->setBirthDate($expected);

        $this->assertEquals($expected, $model->getBirthDate());
    }

    public function testGetHireDate(): void
    {
        $this->assertEquals($this->dto->hireDate, $this->model->getHireDate());
    }

    public function testSetHireDate(): void
    {
        $expected = "2021-09-18";
        $model = $this->model;
        $model->setHireDate($expected);

        $this->assertEquals($expected, $model->getHireDate());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals($this->dto->address, $this->model->getAddress());
    }

    public function testSetAddress(): void
    {
        $expected = "throw";
        $model = $this->model;
        $model->setAddress($expected);

        $this->assertEquals($expected, $model->getAddress());
    }

    public function testGetCity(): void
    {
        $this->assertEquals($this->dto->city, $this->model->getCity());
    }

    public function testSetCity(): void
    {
        $expected = "large";
        $model = $this->model;
        $model->setCity($expected);

        $this->assertEquals($expected, $model->getCity());
    }

    public function testGetRegion(): void
    {
        $this->assertEquals($this->dto->region, $this->model->getRegion());
    }

    public function testSetRegion(): void
    {
        $expected = "teacher";
        $model = $this->model;
        $model->setRegion($expected);

        $this->assertEquals($expected, $model->getRegion());
    }

    public function testGetPostalCode(): void
    {
        $this->assertEquals($this->dto->postalCode, $this->model->getPostalCode());
    }

    public function testSetPostalCode(): void
    {
        $expected = "drug";
        $model = $this->model;
        $model->setPostalCode($expected);

        $this->assertEquals($expected, $model->getPostalCode());
    }

    public function testGetCountry(): void
    {
        $this->assertEquals($this->dto->country, $this->model->getCountry());
    }

    public function testSetCountry(): void
    {
        $expected = "simply";
        $model = $this->model;
        $model->setCountry($expected);

        $this->assertEquals($expected, $model->getCountry());
    }

    public function testGetHomePhone(): void
    {
        $this->assertEquals($this->dto->homePhone, $this->model->getHomePhone());
    }

    public function testSetHomePhone(): void
    {
        $expected = "imagine";
        $model = $this->model;
        $model->setHomePhone($expected);

        $this->assertEquals($expected, $model->getHomePhone());
    }

    public function testGetExtension(): void
    {
        $this->assertEquals($this->dto->extension, $this->model->getExtension());
    }

    public function testSetExtension(): void
    {
        $expected = "work";
        $model = $this->model;
        $model->setExtension($expected);

        $this->assertEquals($expected, $model->getExtension());
    }

    public function testGetPhoto(): void
    {
        $this->assertEquals($this->dto->photo, $this->model->getPhoto());
    }

    public function testSetPhoto(): void
    {
        $expected = "Eye plan activity provide Congress power smile.";
        $model = $this->model;
        $model->setPhoto($expected);

        $this->assertEquals($expected, $model->getPhoto());
    }

    public function testGetNotes(): void
    {
        $this->assertEquals($this->dto->notes, $this->model->getNotes());
    }

    public function testSetNotes(): void
    {
        $expected = "Describe care say off likely pretty. Within safe degree table safe hard traditional.";
        $model = $this->model;
        $model->setNotes($expected);

        $this->assertEquals($expected, $model->getNotes());
    }

    public function testGetReportsTo(): void
    {
        $this->assertEquals($this->dto->reportsTo, $this->model->getReportsTo());
    }

    public function testSetReportsTo(): void
    {
        $expected = 1531;
        $model = $this->model;
        $model->setReportsTo($expected);

        $this->assertEquals($expected, $model->getReportsTo());
    }

    public function testGetPhotoPath(): void
    {
        $this->assertEquals($this->dto->photoPath, $this->model->getPhotoPath());
    }

    public function testSetPhotoPath(): void
    {
        $expected = "vote";
        $model = $this->model;
        $model->setPhotoPath($expected);

        $this->assertEquals($expected, $model->getPhotoPath());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}