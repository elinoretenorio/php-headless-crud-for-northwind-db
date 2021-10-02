<?php

declare(strict_types=1);

namespace Northwind\Territories;

use JsonSerializable;

class TerritoriesModel implements JsonSerializable
{
    private int $territoryId;
    private int $territoryDescription;
    private int $regionId;

    public function __construct(TerritoriesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->territoryId = $dto->territoryId;
        $this->territoryDescription = $dto->territoryDescription;
        $this->regionId = $dto->regionId;
    }

    public function getTerritoryId(): int
    {
        return $this->territoryId;
    }

    public function setTerritoryId(int $territoryId): void
    {
        $this->territoryId = $territoryId;
    }

    public function getTerritoryDescription(): int
    {
        return $this->territoryDescription;
    }

    public function setTerritoryDescription(int $territoryDescription): void
    {
        $this->territoryDescription = $territoryDescription;
    }

    public function getRegionId(): int
    {
        return $this->regionId;
    }

    public function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }

    public function toDto(): TerritoriesDto
    {
        $dto = new TerritoriesDto();
        $dto->territoryId = (int) ($this->territoryId ?? 0);
        $dto->territoryDescription = (int) ($this->territoryDescription ?? 0);
        $dto->regionId = (int) ($this->regionId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "territory_id" => $this->territoryId,
            "territory_description" => $this->territoryDescription,
            "region_id" => $this->regionId,
        ];
    }
}