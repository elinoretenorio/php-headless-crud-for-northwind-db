<?php

declare(strict_types=1);

namespace Northwind\Categories;

use JsonSerializable;

class CategoriesModel implements JsonSerializable
{
    private int $categoryId;
    private string $categoryName;
    private string $description;
    private string $picture;

    public function __construct(CategoriesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->categoryId = $dto->categoryId;
        $this->categoryName = $dto->categoryName;
        $this->description = $dto->description;
        $this->picture = $dto->picture;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPicture(): string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    public function toDto(): CategoriesDto
    {
        $dto = new CategoriesDto();
        $dto->categoryId = (int) ($this->categoryId ?? 0);
        $dto->categoryName = $this->categoryName ?? "";
        $dto->description = $this->description ?? "";
        $dto->picture = $this->picture ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "category_id" => $this->categoryId,
            "category_name" => $this->categoryName,
            "description" => $this->description,
            "picture" => $this->picture,
        ];
    }
}