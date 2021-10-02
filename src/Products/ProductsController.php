<?php

declare(strict_types=1);

namespace Northwind\Products;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class ProductsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IProductsService $service;

    public function __construct(IProductsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ProductsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $productId = (int) ($args["product_id"] ?? 0);
        if ($productId <= 0) {
            return new JsonResponse(["result" => $productId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var ProductsModel $model */
        $model = $this->service->createModel($data);
        $model->setProductId($productId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $productId = (int) ($args["product_id"] ?? 0);
        if ($productId <= 0) {
            return new JsonResponse(["result" => $productId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var ProductsModel $model */
        $model = $this->service->get($productId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var ProductsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $productId = (int) ($args["product_id"] ?? 0);
        if ($productId <= 0) {
            return new JsonResponse(["result" => $productId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($productId);

        return new JsonResponse(["result" => $result]);
    }
}