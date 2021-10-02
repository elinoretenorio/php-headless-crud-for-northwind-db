<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

class EmployeeTerritoriesDto 
{
    public int $employeeTerritoriesId;
    public int $employeeId;
    public string $territoryId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->employeeTerritoriesId = (int) ($row["employee_territories_id"] ?? 0);
        $this->employeeId = (int) ($row["employee_id"] ?? 0);
        $this->territoryId = $row["territory_id"] ?? "";
    }
}