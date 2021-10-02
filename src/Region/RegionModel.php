<?php

declare(strict_types=1);

namespace Northwind\Region;

use JsonSerializable;

class RegionModel implements JsonSerializable
{
    private int $regionId;
    private int $regionDescription;

    public function __construct(RegionDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->regionId = $dto->regionId;
        $this->regionDescription = $dto->regionDescription;
    }

    public function getRegionId(): int
    {
        return $this->regionId;
    }

    public function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }

    public function getRegionDescription(): int
    {
        return $this->regionDescription;
    }

    public function setRegionDescription(int $regionDescription): void
    {
        $this->regionDescription = $regionDescription;
    }

    public function toDto(): RegionDto
    {
        $dto = new RegionDto();
        $dto->regionId = (int) ($this->regionId ?? 0);
        $dto->regionDescription = (int) ($this->regionDescription ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "region_id" => $this->regionId,
            "region_description" => $this->regionDescription,
        ];
    }
}