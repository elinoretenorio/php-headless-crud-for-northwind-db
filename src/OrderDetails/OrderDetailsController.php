<?php

declare(strict_types=1);

namespace Northwind\OrderDetails;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class OrderDetailsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IOrderDetailsService $service;

    public function __construct(IOrderDetailsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var OrderDetailsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $orderDetailsId = (int) ($args["order_details_id"] ?? 0);
        if ($orderDetailsId <= 0) {
            return new JsonResponse(["result" => $orderDetailsId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var OrderDetailsModel $model */
        $model = $this->service->createModel($data);
        $model->setOrderDetailsId($orderDetailsId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $orderDetailsId = (int) ($args["order_details_id"] ?? 0);
        if ($orderDetailsId <= 0) {
            return new JsonResponse(["result" => $orderDetailsId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var OrderDetailsModel $model */
        $model = $this->service->get($orderDetailsId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var OrderDetailsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $orderDetailsId = (int) ($args["order_details_id"] ?? 0);
        if ($orderDetailsId <= 0) {
            return new JsonResponse(["result" => $orderDetailsId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($orderDetailsId);

        return new JsonResponse(["result" => $result]);
    }
}