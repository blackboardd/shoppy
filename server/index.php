<?php

/**
 * Entry point for the server.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Server
 * @package    Shoppy\Server
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

namespace Shoppy\Server;

require_once __DIR__ . '/vendor/autoload.php';
include_once 'Request.php';
include_once 'Router.php';
include_once './model/BookProductMapper.php';
include_once './model/BookProduct.php';
include_once './model/DiscProductMapper.php';
include_once './model/DiscProduct.php';
include_once './model/FurnitureProductMapper.php';
include_once './model/FurnitureProduct.php';
include_once './model/ProductMapper.php';
include_once './model/Product.php';

use Shoppy\Model\Product;
use Dotenv;
use PDOException;
use PDO;

/**
 * Router for the server.
 * 
 * @var Router $router
 */
$router = new Router(new Request);

// Fetch an existing product.
$router->get('/api/v1/product', function ($request) {
    /**
     * test variable
     */
    $product_id = 12;

    /**
     * Create database connection using .env file.
     * 
     * @var Dotenv $dotenv
     */
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    /**
     * Database name.
     * 
     * @var string $database
     */
    $database = $_ENV['MYSQL_DATABASE'];

    /**
     * Database username.
     * 
     * @var string $user
     */
    $user = 'root';

    /**
     * Database password.
     * 
     * @var string $pass
     */
    $pass = $_ENV['MYSQL_ROOT_PASSWORD'];

    /**
     * Database host.
     * 
     * @var string $host
     */
    $host = 'mysql';

    /**
     * Database schema name.
     * 
     * @var string $dsn
     */
    $dsn = 'mysql:host={$host};dbname={$database};charset=utf8mb4';

    try {
        /**
         * Database base handler.
         * 
         * @var PDO $dbh
         */
        $dbh = new PDO($dsn, $user, $pass);

        // set the PDO error mode to exception.
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /**
         * Product mapper.
         * 
         * @var ProductMapper $product
         */
        $productMapper = new Product\ProductMapper($dbh);

        /**
         * Get product by id.
         */
        $product = $productMapper->get($product_id);

        if ($product['type'] === 'disc') {
            /**
             * DiscProduct mapper.
             * 
             * @var DiscProductMapper $discProductMapper
             */
            $discProductMapper = new Product\DiscProductMapper($dbh);

            /**
             * DiscProduct.
             * 
             * @var DiscProduct $discProduct
             */
            $discProduct = $discProductMapper->get($product_id);

            // return disc product
            return $discProduct;
        }

        if ($product['type'] === 'book') {
            /**
             * BookProduct mapper.
             * 
             * @var BookProductMapper $bookProductMapper
             */
            $bookProductMapper = new Product\BookProductMapper($dbh);

            /**
             * BookProduct.
             * 
             * @var BookProduct $bookProduct
             */
            $bookProduct = $bookProductMapper->get($product_id);

            // return book product
            return $bookProduct;
        }

        if ($product['type'] === 'furniture') {
            /**
             * FurnitureProduct mapper.
             * 
             * @var FurnitureProductMapper $furnitureProductMapper
             */
            $furnitureProductMapper = new Product\FurnitureProductMapper($dbh);

            /**
             * FurnitureProduct.
             * 
             * @var FurnitureProduct $furnitureProduct
             */
            $furnitureProduct = $furnitureProductMapper->get($product_id);

            // return furniture product
            return $furnitureProduct;
        }

        
    } catch (PDOException $e) {
        return 'Connection failed: ' . $e->getMessage();
    }

    $body = $request->getBody();

    // Return json encoded data on completion.
    return json_encode($body);
});

// Create a new product.
$router->post('/api/v1/product', function ($request) {
    /**
     * Create database connection using .env file.
     * 
     * @var Dotenv $dotenv
     */
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    /**
     * Database name.
     * 
     * @var string $database
     */
    $database = $_ENV['MYSQL_DATABASE'];

    /**
     * Database username.
     * 
     * @var string $user
     */
    $user = 'root';

    /**
     * Database password.
     * 
     * @var string $pass
     */
    $pass = $_ENV['MYSQL_ROOT_PASSWORD'];

    /**
     * Database host.
     * 
     * @var string $host
     */
    $host = 'mysql';

    /**
     * Database schema name.
     * 
     * @var string $dsn
     */
    $dsn = 'mysql:host={$host};dbname={$database};charset=utf8mb4';

    try {
        /**
         * Database base handler.
         * 
         * @var PDO $dbh
         */
        $dbh = new PDO($dsn, $user, $pass);

        // set the PDO error mode to exception.
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /**
         * Product mapper.
         * 
         * @var ProductMapper $product
         */
        $product = new Product\ProductMapper($dbh);

        /**
         * Get body of request.
         * 
         * @var array
         */
        $body = $request->getBody();

        /**
         * Insert product into the database.
         */
        $product->create(
            new Product\Product(
                $body['id'],
                $body['name'],
                $body['price'],
                $body['currency'],
                $body['type']
            )
        );

        if ($body['disc_id']) {
            /**
             * Disc product mapper
             * 
             * @var Product\DiscProductMapper $disc
             */
            $disc = new Product\DiscProductMapper($dbh);

            /**
             * Insert disc product into the database.
             */
            $disc->create(
                new Product\DiscProduct(
                    $body['disc_id'],
                    $body['size'],
                    $body['unit']
                ),
                $body['id']
            );
        }

        if ($body['furniture_id']) {
            /**
             * Furniture product mapper.
             * 
             * @var Product\FurnitureProductMapper $furniture
             */
            $furniture = new Product\FurnitureProductMapper($dbh);

            /**
             * Insert furniture product into the database.
             */
            $furniture->create(
                new Product\FurnitureProduct(
                    $body['furniture_id'],
                    $body['width'],
                    $body['height'],
                    $body['length']
                ),
                $body['id']
            );
        }

        if ($body['book_id']) {
            /**
             * Book product mapper.
             * 
             * @var Product\BookProductMapper $book
             */
            $book = new Product\BookProductMapper($dbh);

            /**
             * Insert book product into the database.
             */
            $book->create(
                new Product\BookProduct(
                    $body['book_id'],
                    $body['weight'],
                    $body['unit']
                ),
                $body['id']
            );
        }
    } catch (PDOException $e) {
        return 'Connection failed: ' . $e->getMessage();
    }

    $body = $request->getBody();

    // Return json encoded data on completion.
    return json_encode($body);
});
