<?php

declare(strict_types=1);

namespace Northwind\Tests\Suppliers;

use PHPUnit\Framework\TestCase;
use Northwind\Suppliers\{ SuppliersDto, SuppliersModel };

class SuppliersModelTest extends TestCase
{
    private array $input;
    private SuppliersDto $dto;
    private SuppliersModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "supplier_id" => 9353,
            "company_name" => "situation",
            "contact_name" => "add",
            "contact_title" => "story",
            "address" => "according",
            "city" => "contain",
            "region" => "answer",
            "postal_code" => "trip",
            "country" => "collection",
            "phone" => "system",
            "fax" => "single",
            "homepage" => "Our American way structure summer sure.",
        ];
        $this->dto = new SuppliersDto($this->input);
        $this->model = new SuppliersModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new SuppliersModel(null);

        $this->assertInstanceOf(SuppliersModel::class, $model);
    }

    public function testGetSupplierId(): void
    {
        $this->assertEquals($this->dto->supplierId, $this->model->getSupplierId());
    }

    public function testSetSupplierId(): void
    {
        $expected = 1704;
        $model = $this->model;
        $model->setSupplierId($expected);

        $this->assertEquals($expected, $model->getSupplierId());
    }

    public function testGetCompanyName(): void
    {
        $this->assertEquals($this->dto->companyName, $this->model->getCompanyName());
    }

    public function testSetCompanyName(): void
    {
        $expected = "modern";
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
        $expected = "sure";
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
        $expected = "full";
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
        $expected = "official";
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
        $expected = "decide";
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
        $expected = "country";
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
        $expected = "front";
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
        $expected = "major";
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
        $expected = "matter";
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
        $expected = "husband";
        $model = $this->model;
        $model->setFax($expected);

        $this->assertEquals($expected, $model->getFax());
    }

    public function testGetHomepage(): void
    {
        $this->assertEquals($this->dto->homepage, $this->model->getHomepage());
    }

    public function testSetHomepage(): void
    {
        $expected = "Between whatever use lead alone across without. Suggest design key want.";
        $model = $this->model;
        $model->setHomepage($expected);

        $this->assertEquals($expected, $model->getHomepage());
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