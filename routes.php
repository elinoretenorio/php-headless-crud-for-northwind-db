<?php

declare(strict_types=1);

$router->get("/categories", "Northwind\Categories\CategoriesController::getAll");
$router->post("/categories", "Northwind\Categories\CategoriesController::insert");
$router->group("/categories", function ($router) {
    $router->get("/{category_id:number}", "Northwind\Categories\CategoriesController::get");
    $router->post("/{category_id:number}", "Northwind\Categories\CategoriesController::update");
    $router->delete("/{category_id:number}", "Northwind\Categories\CategoriesController::delete");
});

$router->get("/customer-demographics", "Northwind\CustomerDemographics\CustomerDemographicsController::getAll");
$router->post("/customer-demographics", "Northwind\CustomerDemographics\CustomerDemographicsController::insert");
$router->group("/customer-demographics", function ($router) {
    $router->get("/{customer_demographics_id:number}", "Northwind\CustomerDemographics\CustomerDemographicsController::get");
    $router->post("/{customer_demographics_id:number}", "Northwind\CustomerDemographics\CustomerDemographicsController::update");
    $router->delete("/{customer_demographics_id:number}", "Northwind\CustomerDemographics\CustomerDemographicsController::delete");
});

$router->get("/customers", "Northwind\Customers\CustomersController::getAll");
$router->post("/customers", "Northwind\Customers\CustomersController::insert");
$router->group("/customers", function ($router) {
    $router->get("/{customer_id:number}", "Northwind\Customers\CustomersController::get");
    $router->post("/{customer_id:number}", "Northwind\Customers\CustomersController::update");
    $router->delete("/{customer_id:number}", "Northwind\Customers\CustomersController::delete");
});

$router->get("/customer-demo", "Northwind\CustomerDemo\CustomerDemoController::getAll");
$router->post("/customer-demo", "Northwind\CustomerDemo\CustomerDemoController::insert");
$router->group("/customer-demo", function ($router) {
    $router->get("/{customer_demo_id:number}", "Northwind\CustomerDemo\CustomerDemoController::get");
    $router->post("/{customer_demo_id:number}", "Northwind\CustomerDemo\CustomerDemoController::update");
    $router->delete("/{customer_demo_id:number}", "Northwind\CustomerDemo\CustomerDemoController::delete");
});

$router->get("/employees", "Northwind\Employees\EmployeesController::getAll");
$router->post("/employees", "Northwind\Employees\EmployeesController::insert");
$router->group("/employees", function ($router) {
    $router->get("/{employee_id:number}", "Northwind\Employees\EmployeesController::get");
    $router->post("/{employee_id:number}", "Northwind\Employees\EmployeesController::update");
    $router->delete("/{employee_id:number}", "Northwind\Employees\EmployeesController::delete");
});

$router->get("/suppliers", "Northwind\Suppliers\SuppliersController::getAll");
$router->post("/suppliers", "Northwind\Suppliers\SuppliersController::insert");
$router->group("/suppliers", function ($router) {
    $router->get("/{supplier_id:number}", "Northwind\Suppliers\SuppliersController::get");
    $router->post("/{supplier_id:number}", "Northwind\Suppliers\SuppliersController::update");
    $router->delete("/{supplier_id:number}", "Northwind\Suppliers\SuppliersController::delete");
});

$router->get("/products", "Northwind\Products\ProductsController::getAll");
$router->post("/products", "Northwind\Products\ProductsController::insert");
$router->group("/products", function ($router) {
    $router->get("/{product_id:number}", "Northwind\Products\ProductsController::get");
    $router->post("/{product_id:number}", "Northwind\Products\ProductsController::update");
    $router->delete("/{product_id:number}", "Northwind\Products\ProductsController::delete");
});

$router->get("/region", "Northwind\Region\RegionController::getAll");
$router->post("/region", "Northwind\Region\RegionController::insert");
$router->group("/region", function ($router) {
    $router->get("/{region_id:number}", "Northwind\Region\RegionController::get");
    $router->post("/{region_id:number}", "Northwind\Region\RegionController::update");
    $router->delete("/{region_id:number}", "Northwind\Region\RegionController::delete");
});

$router->get("/shippers", "Northwind\Shippers\ShippersController::getAll");
$router->post("/shippers", "Northwind\Shippers\ShippersController::insert");
$router->group("/shippers", function ($router) {
    $router->get("/{shipper_id:number}", "Northwind\Shippers\ShippersController::get");
    $router->post("/{shipper_id:number}", "Northwind\Shippers\ShippersController::update");
    $router->delete("/{shipper_id:number}", "Northwind\Shippers\ShippersController::delete");
});

$router->get("/orders", "Northwind\Orders\OrdersController::getAll");
$router->post("/orders", "Northwind\Orders\OrdersController::insert");
$router->group("/orders", function ($router) {
    $router->get("/{order_id:number}", "Northwind\Orders\OrdersController::get");
    $router->post("/{order_id:number}", "Northwind\Orders\OrdersController::update");
    $router->delete("/{order_id:number}", "Northwind\Orders\OrdersController::delete");
});

$router->get("/territories", "Northwind\Territories\TerritoriesController::getAll");
$router->post("/territories", "Northwind\Territories\TerritoriesController::insert");
$router->group("/territories", function ($router) {
    $router->get("/{territory_id:number}", "Northwind\Territories\TerritoriesController::get");
    $router->post("/{territory_id:number}", "Northwind\Territories\TerritoriesController::update");
    $router->delete("/{territory_id:number}", "Northwind\Territories\TerritoriesController::delete");
});

$router->get("/employee-territories", "Northwind\EmployeeTerritories\EmployeeTerritoriesController::getAll");
$router->post("/employee-territories", "Northwind\EmployeeTerritories\EmployeeTerritoriesController::insert");
$router->group("/employee-territories", function ($router) {
    $router->get("/{employee_territories_id:number}", "Northwind\EmployeeTerritories\EmployeeTerritoriesController::get");
    $router->post("/{employee_territories_id:number}", "Northwind\EmployeeTerritories\EmployeeTerritoriesController::update");
    $router->delete("/{employee_territories_id:number}", "Northwind\EmployeeTerritories\EmployeeTerritoriesController::delete");
});

$router->get("/order-details", "Northwind\OrderDetails\OrderDetailsController::getAll");
$router->post("/order-details", "Northwind\OrderDetails\OrderDetailsController::insert");
$router->group("/order-details", function ($router) {
    $router->get("/{order_details_id:number}", "Northwind\OrderDetails\OrderDetailsController::get");
    $router->post("/{order_details_id:number}", "Northwind\OrderDetails\OrderDetailsController::update");
    $router->delete("/{order_details_id:number}", "Northwind\OrderDetails\OrderDetailsController::delete");
});

$router->get("/us-states", "Northwind\UsStates\UsStatesController::getAll");
$router->post("/us-states", "Northwind\UsStates\UsStatesController::insert");
$router->group("/us-states", function ($router) {
    $router->get("/{state_id:number}", "Northwind\UsStates\UsStatesController::get");
    $router->post("/{state_id:number}", "Northwind\UsStates\UsStatesController::update");
    $router->delete("/{state_id:number}", "Northwind\UsStates\UsStatesController::delete");
});

