<?php

declare(strict_types=1);

namespace Northwind\UsStates;

class UsStatesDto 
{
    public int $stateId;
    public string $stateName;
    public string $stateAbbr;
    public string $stateRegion;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->stateId = (int) ($row["state_id"] ?? 0);
        $this->stateName = $row["state_name"] ?? "";
        $this->stateAbbr = $row["state_abbr"] ?? "";
        $this->stateRegion = $row["state_region"] ?? "";
    }
}