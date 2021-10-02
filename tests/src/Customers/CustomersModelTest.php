<?php

declare(strict_types=1);

namespace Northwind\Tests\Customers;

use PHPUnit\Framework\TestCase;
use Northwind\Customers\{ CustomersDto, CustomersModel };

class CustomersModelTest extends TestCase
{
    private array $input;
    private CustomersDto $dto;
    private CustomersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "customer_id" => 4825,
            "company_name" => "nothing",
            "contact_name" => "possible",
            "contact_title" => "gun",
            "address" => "rest",
            "city" => "region",
            "region" => "page",
            "postal_code" => "make",
            "country" => "time",
            "phone" => "leave",
            "fax" => "lose",
        ];
        $this->dto = new CustomersDto($this->input);
        $this->model = new CustomersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CustomersModel(null);

        $this->assertInstanceOf(CustomersModel::class, $model);
    }

    public function testGetCustomerId(): void
    {
        $this->assertEquals($this->dto->customerId, $this->model->getCustomerId());
    }

    public function testSetCustomerId(): void
    {
        $expected = 7601;
        $model = $this->model;
        $model->setCustomerId($expected);

        $this->assertEquals($expected, $model->getCustomerId());
    }

    public function testGetCompanyName(): void
    {
        $this->assertEquals($this->dto->companyName, $this->model->getCompanyName());
    }

    public function testSetCompanyName(): void
    {
        $expected = "catch";
        $model = $this->model;
        $model->setCompanyName($expected);

        $this->assertEquals($expected, $model->getCompanyName());
    }

    public function testGetContactName(): void
    {
        $this->assertEquals($this->dto->contactName, $this->model->getContactName());
    }

    public function testSetContactName(): void
    {
        $expected = "budget";
        $model = $this->model;
        $model->setContactName($expected);

        $this->assertEquals($expected, $model->getContactName());
    }

    public function testGetContactTitle(): void
    {
        $this->assertEquals($this->dto->contactTitle, $this->model->getContactTitle());
    }

    public function testSetContactTitle(): void
    {
        $expected = "recently";
        $model = $this->model;
        $model->setContactTitle($expected);

        $this->assertEquals($expected, $model->getContactTitle());
    }

    public function testGetAddress(): void
    {
        $this->assertEquals($this->dto->address, $this->model->getAddress());
    }

    public function testSetAddress(): void
    {
        $expected = "technology";
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
        $expected = "speak";
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
        $expected = "area";
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
        $expected = "capital";
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
        $expected = "suddenly";
        $model = $this->model;
        $model->setCountry($expected);

        $this->assertEquals($expected, $model->getCountry());
    }

    public function testGetPhone(): void
    {
        $this->assertEquals($this->dto->phone, $this->model->getPhone());
    }

    public function testSetPhone(): void
    {
        $expected = "situation";
        $model = $this->model;
        $model->setPhone($expected);

        $this->assertEquals($expected, $model->getPhone());
    }

    public function testGetFax(): void
    {
        $this->assertEquals($this->dto->fax, $this->model->getFax());
    }

    public function testSetFax(): void
    {
        $expected = "each";
        $model = $this->model;
        $model->setFax($expected);

        $this->assertEquals($expected, $model->getFax());
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