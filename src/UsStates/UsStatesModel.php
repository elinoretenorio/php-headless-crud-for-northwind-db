<?php

declare(strict_types=1);

namespace Northwind\UsStates;

use JsonSerializable;

class UsStatesModel implements JsonSerializable
{
    private int $stateId;
    private string $stateName;
    private string $stateAbbr;
    private string $stateRegion;

    public function __construct(UsStatesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->stateId = $dto->stateId;
        $this->stateName = $dto->stateName;
        $this->stateAbbr = $dto->stateAbbr;
        $this->stateRegion = $dto->stateRegion;
    }

    public function getStateId(): int
    {
        return $this->stateId;
    }

    public function setStateId(int $stateId): void
    {
        $this->stateId = $stateId;
    }

    public function getStateName(): string
    {
        return $this->stateName;
    }

    public function setStateName(string $stateName): void
    {
        $this->stateName = $stateName;
    }

    public function getStateAbbr(): string
    {
        return $this->stateAbbr;
    }

    public function setStateAbbr(string $stateAbbr): void
    {
        $this->stateAbbr = $stateAbbr;
    }

    public function getStateRegion(): string
    {
        return $this->stateRegion;
    }

    public function setStateRegion(string $stateRegion): void
    {
        $this->stateRegion = $stateRegion;
    }

    public function toDto(): UsStatesDto
    {
        $dto = new UsStatesDto();
        $dto->stateId = (int) ($this->stateId ?? 0);
        $dto->stateName = $this->stateName ?? "";
        $dto->stateAbbr = $this->stateAbbr ?? "";
        $dto->stateRegion = $this->stateRegion ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "state_id" => $this->stateId,
            "state_name" => $this->stateName,
            "state_abbr" => $this->stateAbbr,
            "state_region" => $this->stateRegion,
        ];
    }
}