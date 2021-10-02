<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", Northwind\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Categories

$container->add("CategoriesRepository", Northwind\Categories\CategoriesRepository::class)
    ->addArgument("Database");
$container->add("CategoriesService", Northwind\Categories\CategoriesService::class)
    ->addArgument("CategoriesRepository");
$container->add(Northwind\Categories\CategoriesController::class)
    ->addArgument("CategoriesService");

// CustomerDemographics

$container->add("CustomerDemographicsRepository", Northwind\CustomerDemographics\CustomerDemographicsRepository::class)
    ->addArgument("Database");
$container->add("CustomerDemographicsService", Northwind\CustomerDemographics\CustomerDemographicsService::class)
    ->addArgument("CustomerDemographicsRepository");
$container->add(Northwind\CustomerDemographics\CustomerDemographicsController::class)
    ->addArgument("CustomerDemographicsService");

// Customers

$container->add("CustomersRepository", Northwind\Customers\CustomersRepository::class)
    ->addArgument("Database");
$container->add("CustomersService", Northwind\Customers\CustomersService::class)
    ->addArgument("CustomersRepository");
$container->add(Northwind\Customers\CustomersController::class)
    ->addArgument("CustomersService");

// CustomerDemo

$container->add("CustomerDemoRepository", Northwind\CustomerDemo\CustomerDemoRepository::class)
    ->addArgument("Database");
$container->add("CustomerDemoService", Northwind\CustomerDemo\CustomerDemoService::class)
    ->addArgument("CustomerDemoRepository");
$container->add(Northwind\CustomerDemo\CustomerDemoController::class)
    ->addArgument("CustomerDemoService");

// Employees

$container->add("EmployeesRepository", Northwind\Employees\EmployeesRepository::class)
    ->addArgument("Database");
$container->add("EmployeesService", Northwind\Employees\EmployeesService::class)
    ->addArgument("EmployeesRepository");
$container->add(Northwind\Employees\EmployeesController::class)
    ->addArgument("EmployeesService");

// Suppliers

$container->add("SuppliersRepository", Northwind\Suppliers\SuppliersRepository::class)
    ->addArgument("Database");
$container->add("SuppliersService", Northwind\Suppliers\SuppliersService::class)
    ->addArgument("SuppliersRepository");
$container->add(Northwind\Suppliers\SuppliersController::class)
    ->addArgument("SuppliersService");

// Products

$container->add("ProductsRepository", Northwind\Products\ProductsRepository::class)
    ->addArgument("Database");
$container->add("ProductsService", Northwind\Products\ProductsService::class)
    ->addArgument("ProductsRepository");
$container->add(Northwind\Products\ProductsController::class)
    ->addArgument("ProductsService");

// Region

$container->add("RegionRepository", Northwind\Region\RegionRepository::class)
    ->addArgument("Database");
$container->add("RegionService", Northwind\Region\RegionService::class)
    ->addArgument("RegionRepository");
$container->add(Northwind\Region\RegionController::class)
    ->addArgument("RegionService");

// Shippers

$container->add("ShippersRepository", Northwind\Shippers\ShippersRepository::class)
    ->addArgument("Database");
$container->add("ShippersService", Northwind\Shippers\ShippersService::class)
    ->addArgument("ShippersRepository");
$container->add(Northwind\Shippers\ShippersController::class)
    ->addArgument("ShippersService");

// Orders

$container->add("OrdersRepository", Northwind\Orders\OrdersRepository::class)
    ->addArgument("Database");
$container->add("OrdersService", Northwind\Orders\OrdersService::class)
    ->addArgument("OrdersRepository");
$container->add(Northwind\Orders\OrdersController::class)
    ->addArgument("OrdersService");

// Territories

$container->add("TerritoriesRepository", Northwind\Territories\TerritoriesRepository::class)
    ->addArgument("Database");
$container->add("TerritoriesService", Northwind\Territories\TerritoriesService::class)
    ->addArgument("TerritoriesRepository");
$container->add(Northwind\Territories\TerritoriesController::class)
    ->addArgument("TerritoriesService");

// EmployeeTerritories

$container->add("EmployeeTerritoriesRepository", Northwind\EmployeeTerritories\EmployeeTerritoriesRepository::class)
    ->addArgument("Database");
$container->add("EmployeeTerritoriesService", Northwind\EmployeeTerritories\EmployeeTerritoriesService::class)
    ->addArgument("EmployeeTerritoriesRepository");
$container->add(Northwind\EmployeeTerritories\EmployeeTerritoriesController::class)
    ->addArgument("EmployeeTerritoriesService");

// OrderDetails

$container->add("OrderDetailsRepository", Northwind\OrderDetails\OrderDetailsRepository::class)
    ->addArgument("Database");
$container->add("OrderDetailsService", Northwind\OrderDetails\OrderDetailsService::class)
    ->addArgument("OrderDetailsRepository");
$container->add(Northwind\OrderDetails\OrderDetailsController::class)
    ->addArgument("OrderDetailsService");

// UsStates

$container->add("UsStatesRepository", Northwind\UsStates\UsStatesRepository::class)
    ->addArgument("Database");
$container->add("UsStatesService", Northwind\UsStates\UsStatesService::class)
    ->addArgument("UsStatesRepository");
$container->add(Northwind\UsStates\UsStatesController::class)
    ->addArgument("UsStatesService");

