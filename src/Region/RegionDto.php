<?php

declare(strict_types=1);

namespace Northwind\Region;

class RegionDto 
{
    public int $regionId;
    public int $regionDescription;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->regionId = (int) ($row["region_id"] ?? 0);
        $this->regionDescription = (int) ($row["region_description"] ?? 0);
    }
}