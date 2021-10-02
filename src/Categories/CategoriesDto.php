<?php

declare(strict_types=1);

namespace Northwind\Categories;

class CategoriesDto 
{
    public int $categoryId;
    public string $categoryName;
    public string $description;
    public string $picture;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->categoryId = (int) ($row["category_id"] ?? 0);
        $this->categoryName = $row["category_name"] ?? "";
        $this->description = $row["description"] ?? "";
        $this->picture = $row["picture"] ?? "";
    }
}