<?php

declare(strict_types=1);

namespace Northwind\Customers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CustomersController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICustomersService $service;

    public function __construct(ICustomersService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CustomersModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $customerId = (int) ($args["customer_id"] ?? 0);
        if ($customerId <= 0) {
            return new JsonResponse(["result" => $customerId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CustomersModel $model */
        $model = $this->service->createModel($data);
        $model->setCustomerId($customerId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $customerId = (int) ($args["customer_id"] ?? 0);
        if ($customerId <= 0) {
            return new JsonResponse(["result" => $customerId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CustomersModel $model */
        $model = $this->service->get($customerId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CustomersModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $customerId = (int) ($args["customer_id"] ?? 0);
        if ($customerId <= 0) {
            return new JsonResponse(["result" => $customerId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($customerId);

        return new JsonResponse(["result" => $result]);
    }
}