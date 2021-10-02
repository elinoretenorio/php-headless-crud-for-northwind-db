<?php

declare(strict_types=1);

namespace Northwind\Region;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class RegionRepository implements IRegionRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(RegionDto $dto): int
    {
        $sql = "INSERT INTO `region` (`region_description`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->regionDescription
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(RegionDto $dto): int
    {
        $sql = "UPDATE `region` SET `region_description` = ?
                WHERE `region_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->regionDescription,
                $dto->regionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $regionId): ?RegionDto
    {
        $sql = "SELECT `region_id`, `region_description`
                FROM `region` WHERE `region_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$regionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new RegionDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `region_id`, `region_description`
                FROM `region`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new RegionDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $regionId): int
    {
        $sql = "DELETE FROM `region` WHERE `region_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$regionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}