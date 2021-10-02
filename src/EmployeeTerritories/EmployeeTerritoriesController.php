<?php

declare(strict_types=1);

namespace Northwind\EmployeeTerritories;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class EmployeeTerritoriesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IEmployeeTerritoriesService $service;

    public function __construct(IEmployeeTerritoriesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var EmployeeTerritoriesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $employeeTerritoriesId = (int) ($args["employee_territories_id"] ?? 0);
        if ($employeeTerritoriesId <= 0) {
            return new JsonResponse(["result" => $employeeTerritoriesId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var EmployeeTerritoriesModel $model */
        $model = $this->service->createModel($data);
        $model->setEmployeeTerritoriesId($employeeTerritoriesId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $employeeTerritoriesId = (int) ($args["employee_territories_id"] ?? 0);
        if ($employeeTerritoriesId <= 0) {
            return new JsonResponse(["result" => $employeeTerritoriesId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var EmployeeTerritoriesModel $model */
        $model = $this->service->get($employeeTerritoriesId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var EmployeeTerritoriesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $employeeTerritoriesId = (int) ($args["employee_territories_id"] ?? 0);
        if ($employeeTerritoriesId <= 0) {
            return new JsonResponse(["result" => $employeeTerritoriesId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($employeeTerritoriesId);

        return new JsonResponse(["result" => $result]);
    }
}