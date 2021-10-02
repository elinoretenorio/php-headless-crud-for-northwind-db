<?php

declare(strict_types=1);

namespace Northwind\Territories;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TerritoriesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ITerritoriesService $service;

    public function __construct(ITerritoriesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TerritoriesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $territoryId = (int) ($args["territory_id"] ?? 0);
        if ($territoryId <= 0) {
            return new JsonResponse(["result" => $territoryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var TerritoriesModel $model */
        $model = $this->service->createModel($data);
        $model->setTerritoryId($territoryId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $territoryId = (int) ($args["territory_id"] ?? 0);
        if ($territoryId <= 0) {
            return new JsonResponse(["result" => $territoryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var TerritoriesModel $model */
        $model = $this->service->get($territoryId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var TerritoriesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $territoryId = (int) ($args["territory_id"] ?? 0);
        if ($territoryId <= 0) {
            return new JsonResponse(["result" => $territoryId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($territoryId);

        return new JsonResponse(["result" => $result]);
    }
}