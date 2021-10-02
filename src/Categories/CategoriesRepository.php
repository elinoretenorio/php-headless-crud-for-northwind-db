<?php

declare(strict_types=1);

namespace Northwind\Categories;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class CategoriesRepository implements ICategoriesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CategoriesDto $dto): int
    {
        $sql = "INSERT INTO `categories` (`category_name`, `description`, `picture`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->categoryName,
                $dto->description,
                $dto->picture
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CategoriesDto $dto): int
    {
        $sql = "UPDATE `categories` SET `category_name` = ?, `description` = ?, `picture` = ?
                WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->categoryName,
                $dto->description,
                $dto->picture,
                $dto->categoryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $categoryId): ?CategoriesDto
    {
        $sql = "SELECT `category_id`, `category_name`, `description`, `picture`
                FROM `categories` WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$categoryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CategoriesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `category_id`, `category_name`, `description`, `picture`
                FROM `categories`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CategoriesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $categoryId): int
    {
        $sql = "DELETE FROM `categories` WHERE `category_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$categoryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}