<?php

declare(strict_types=1);

namespace Northwind\Territories;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class TerritoriesRepository implements ITerritoriesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(TerritoriesDto $dto): int
    {
        $sql = "INSERT INTO `territories` (`territory_description`, `region_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->territoryDescription,
                $dto->regionId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(TerritoriesDto $dto): int
    {
        $sql = "UPDATE `territories` SET `territory_description` = ?, `region_id` = ?
                WHERE `territory_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->territoryDescription,
                $dto->regionId,
                $dto->territoryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $territoryId): ?TerritoriesDto
    {
        $sql = "SELECT `territory_id`, `territory_description`, `region_id`
                FROM `territories` WHERE `territory_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$territoryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new TerritoriesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `territory_id`, `territory_description`, `region_id`
                FROM `territories`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new TerritoriesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $territoryId): int
    {
        $sql = "DELETE FROM `territories` WHERE `territory_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$territoryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}