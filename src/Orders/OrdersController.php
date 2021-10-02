<?php

declare(strict_types=1);

namespace Northwind\Orders;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class OrdersController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IOrdersService $service;

    public function __construct(IOrdersService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var OrdersModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $orderId = (int) ($args["order_id"] ?? 0);
        if ($orderId <= 0) {
            return new JsonResponse(["result" => $orderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var OrdersModel $model */
        $model = $this->service->createModel($data);
        $model->setOrderId($orderId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $orderId = (int) ($args["order_id"] ?? 0);
        if ($orderId <= 0) {
            return new JsonResponse(["result" => $orderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var OrdersModel $model */
        $model = $this->service->get($orderId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var OrdersModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $orderId = (int) ($args["order_id"] ?? 0);
        if ($orderId <= 0) {
            return new JsonResponse(["result" => $orderId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($orderId);

        return new JsonResponse(["result" => $result]);
    }
}