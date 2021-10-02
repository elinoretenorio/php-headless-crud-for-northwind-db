<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

use JsonSerializable;

class EmployeeTerritoriesModel implements JsonSerializable
{
    private int $employeeTerritoriesId;
    private int $employeeId;
    private string $territoryId;

    public function __construct(EmployeeTerritoriesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->employeeTerritoriesId = $dto->employeeTerritoriesId;
        $this->employeeId = $dto->employeeId;
        $this->territoryId = $dto->territoryId;
    }

    public function getEmployeeTerritoriesId(): int
    {
        return $this->employeeTerritoriesId;
    }

    public function setEmployeeTerritoriesId(int $employeeTerritoriesId): void
    {
        $this->employeeTerritoriesId = $employeeTerritoriesId;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getTerritoryId(): string
    {
        return $this->territoryId;
    }

    public function setTerritoryId(string $territoryId): void
    {
        $this->territoryId = $territoryId;
    }

    public function toDto(): EmployeeTerritoriesDto
    {
        $dto = new EmployeeTerritoriesDto();
        $dto->employeeTerritoriesId = (int) ($this->employeeTerritoriesId ?? 0);
        $dto->employeeId = (int) ($this->employeeId ?? 0);
        $dto->territoryId = $this->territoryId ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "employee_territories_id" => $this->employeeTerritoriesId,
            "employee_id" => $this->employeeId,
            "territory_id" => $this->territoryId,
        ];
    }
}