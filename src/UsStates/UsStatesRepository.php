<?php

declare(strict_types=1);

namespace Northwind\UsStates;

use Northwind\Database\IDatabase;
use Northwind\Database\DatabaseException;

class UsStatesRepository implements IUsStatesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(UsStatesDto $dto): int
    {
        $sql = "INSERT INTO `us_states` (`state_name`, `state_abbr`, `state_region`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->stateName,
                $dto->stateAbbr,
                $dto->stateRegion
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(UsStatesDto $dto): int
    {
        $sql = "UPDATE `us_states` SET `state_name` = ?, `state_abbr` = ?, `state_region` = ?
                WHERE `state_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->stateName,
                $dto->stateAbbr,
                $dto->stateRegion,
                $dto->stateId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $stateId): ?UsStatesDto
    {
        $sql = "SELECT `state_id`, `state_name`, `state_abbr`, `state_region`
                FROM `us_states` WHERE `state_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$stateId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new UsStatesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `state_id`, `state_name`, `state_abbr`, `state_region`
                FROM `us_states`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new UsStatesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $stateId): int
    {
        $sql = "DELETE FROM `us_states` WHERE `state_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$stateId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}