<?php

declare(strict_types=1);

namespace Northwind\UsStates;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class UsStatesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IUsStatesService $service;

    public function __construct(IUsStatesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var UsStatesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $stateId = (int) ($args["state_id"] ?? 0);
        if ($stateId <= 0) {
            return new JsonResponse(["result" => $stateId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var UsStatesModel $model */
        $model = $this->service->createModel($data);
        $model->setStateId($stateId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $stateId = (int) ($args["state_id"] ?? 0);
        if ($stateId <= 0) {
            return new JsonResponse(["result" => $stateId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var UsStatesModel $model */
        $model = $this->service->get($stateId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var UsStatesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $stateId = (int) ($args["state_id"] ?? 0);
        if ($stateId <= 0) {
            return new JsonResponse(["result" => $stateId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($stateId);

        return new JsonResponse(["result" => $result]);
    }
}