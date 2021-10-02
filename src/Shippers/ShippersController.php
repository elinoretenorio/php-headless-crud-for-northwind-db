<?php

declare(strict_types=1);

namespace Northwind\Shippers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ShippersController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IShippersService $service;

    public function __construct(IShippersService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ShippersModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $shipperId = (int) ($args["shipper_id"] ?? 0);
        if ($shipperId <= 0) {
            return new JsonResponse(["result" => $shipperId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ShippersModel $model */
        $model = $this->service->createModel($data);
        $model->setShipperId($shipperId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $shipperId = (int) ($args["shipper_id"] ?? 0);
        if ($shipperId <= 0) {
            return new JsonResponse(["result" => $shipperId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var ShippersModel $model */
        $model = $this->service->get($shipperId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var ShippersModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $shipperId = (int) ($args["shipper_id"] ?? 0);
        if ($shipperId <= 0) {
            return new JsonResponse(["result" => $shipperId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($shipperId);

        return new JsonResponse(["result" => $result]);
    }
}