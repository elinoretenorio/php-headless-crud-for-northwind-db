<?php

declare(strict_types=1);

namespace Northwind\Territories;

class TerritoriesDto 
{
    public int $territoryId;
    public int $territoryDescription;
    public int $regionId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->territoryId = (int) ($row["territory_id"] ?? 0);
        $this->territoryDescription = (int) ($row["territory_description"] ?? 0);
        $this->regionId = (int) ($row["region_id"] ?? 0);
    }
}