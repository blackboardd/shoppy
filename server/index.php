<?php

/**
 * Entry point for the server.
 *
 * PHP version 7.4
 *
 * @category  Server
 * @package   Shoppy\Server
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */

namespace Shoppy\Server;

require_once __DIR__ . '/vendor/autoload.php';
require_once './model/ProductMapper.php';
require_once './model/Product.php';
require_once './Database.php';

use Dotenv;
use PDOException;
use PDO;
use Shoppy\Model\ProductMapper;
use Shoppy\Model\Product;

/**
 * Router for the server.
 *
 * @var \Klein\Klein $router
 */
$router = new \Klein\Klein();

// Create a new product.
$router->respond(
    'POST',
    '/api/v1/products',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            // Create product table if it doesn't exist.
            Product::createTable($db);

            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Product model.
             *
             * @var Product $product
             */
            $model = new Product(
                $req->id,
                $req->sku,
                $req->name,
                $req->price,
                $req->currency,
                $req->type,
                $req->unit,
                $req->unit_value
            );

            /**
             * Insert product into the database.
             */
            $mapper->create($model);

            /**
             * Product.
             *
             * @var Product $product
             */
            $product = $mapper->get($req->id);

            return json_encode($product);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

// Fetch all products.
$router->respond(
    'GET',
    '/api/v1/products',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            // Create product table if it doesn't exist.
            Product::createTable($db);

            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Fetch all products.
             *
             * @var array $products
             */
            $products = $mapper->getAll();

            return json_encode($products);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

// Fetch an existing product.
$router->respond(
    'GET',
    '/api/v1/products/[i:id]',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Product.
             *
             * @var Product $product
             */
            $product = $mapper->get($req->id);

            return json_encode($product);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

// Update an existing product.
$router->respond(
    'PUT',
    '/api/v1/product/[i:id]',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Product model.
             *
             * @var Product $product
             */
            $model = new Product(
                $req->id,
                $req->sku,
                $req->name,
                $req->price,
                $req->currency,
                $req->type,
                $req->unit,
                $req->unit_value
            );

            /**
             * Update product in the database.
             */
            $mapper->update($model);

            /**
             * Product.
             *
             * @var Product $product
             */
            $product = $mapper->get($req->id);

            return json_encode($product);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

// Delete an existing product.
$router->respond(
    'DELETE',
    '/api/v1/product/[i:id]',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Product.
             *
             * @var Product $product
             */
            $product = $mapper->get($req->id);

            /**
             * Delete product from the database.
             */
            $mapper->delete($req->id);

            return json_encode($product);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

// Delete all products.
$router->respond(
    'DELETE',
    '/api/v1/products',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            // Create product table if it doesn't exist.
            Product::createTable($db);

            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Delete all products from the database.
             */
            $mapper->deleteAll();

            return json_encode([]);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

/**
 * Refresh the database by deleting all products, dropping the table, and then
 * re-creating it. This route will also introduce test data for all three types
 * of products: books, furniture, and discs.
 */ 
$router->respond(
    'GET',
    '/api/v1/refresh',
    function ($req) {
        /**
         * Initialize database.
         *
         * @var PDO $db
         */
        $db = (new Database())->connect();

        try {
            /**
             * Product mapper.
             *
             * @var ProductMapper $mapper
             */
            $mapper = new ProductMapper($db);

            /**
             * Drop product table.
             */
            Product::dropTable($db);

            /**
             * Create product table.
             */
            Product::createTable($db);

            /**
             * Create test data.
             */
            Product::createTestData($db);

            /**
             * Fetch all products.
             *
             * @var array $products
             */
            $products = $mapper->getAll();

            return json_encode($products);
        } catch (PDOException $e) {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
);

$router->dispatch();
