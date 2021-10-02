<?php

declare(strict_types=1);

namespace Northwind\Region;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class RegionController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IRegionService $service;

    public function __construct(IRegionService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var RegionModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $regionId = (int) ($args["region_id"] ?? 0);
        if ($regionId <= 0) {
            return new JsonResponse(["result" => $regionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var RegionModel $model */
        $model = $this->service->createModel($data);
        $model->setRegionId($regionId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $regionId = (int) ($args["region_id"] ?? 0);
        if ($regionId <= 0) {
            return new JsonResponse(["result" => $regionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var RegionModel $model */
        $model = $this->service->get($regionId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var RegionModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $regionId = (int) ($args["region_id"] ?? 0);
        if ($regionId <= 0) {
            return new JsonResponse(["result" => $regionId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($regionId);

        return new JsonResponse(["result" => $result]);
    }
}