<?php

/**
 * Disc product data mapper.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Product
 * @package    Shoppy\Model\Product
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Shoppy\Model\Product;

// {{{ DiscProductMapperInterface

/**
 * Interface for disc product mapper objects.
 */
interface DiscProductMapperInterface {
    // {{{ get()

    /**
     * Get a disc product by id.
     * 
     * @param int $product_id The id of the product to find.
     * 
     * @access public
     * @return DiscProduct The product.
     */
    public function get(int $product_id): DiscProduct;

    // }}}
    // {{{ update()

    /**
     * Update a disc product.
     * 
     * @param DiscProduct $product The product to update.
     * @param int $product_id The id of the product to update.
     * 
     * @access public
     * @return void
     */
    public function update(DiscProduct $product, int $product_id);

    // }}}
    // {{{ delete()

    /**
     * Delete a product.
     * 
     * @param int $product_id The id of the product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(int $product_id);

    // }}}
    // {{{ create()

    /**
     * Create a disc product.
     * 
     * @param DiscProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(DiscProduct $product, int $product_id);
}

// }}}
// {{{ DiscProductMapper

/**
 * Class for disc product objects.
 */
class DiscProductMapper implements DiscProductMapperInterface {
    // {{{ __construct()

    /**
     * Constructor.
     * 
     * @param PDO $db The database connection.
     * 
     * @access public
     * @return void
     */
    public function __construct(private \PDO $db) {
    }

    // }}}
    // {{{ get()

    /**
     * Get a product by id.
     * 
     * @param int $product_id The id of the product to find.
     * 
     * @access public
     * @return DiscProduct The product.
     */
    public function get(int $product_id): DiscProduct {
        /**
         * query string for getting a product by id.
         * 
         * @var string $query
         */
        $query = 'SELECT * FROM disc_product WHERE product_id = :id';

        /**
         * Statement that prepares a database with the given query.
         * 
         * @var PDOStatement $stmt
         */
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized id for the query.
         * 
         * @var int $id
         */
        $id = filter_input(
            INPUT_GET,
            number_format($product_id, 0, '.', ''),
            FILTER_SANITIZE_NUMBER_INT
        );

        /**
         * Binds the id to the query.
         */
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();

        /**
         * Fetches the product from the database.
         */
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            die('Record not found');
        }

        return DiscProduct::fromState($result);
    }

    // }}}
    // {{{ update()

    /**
     * Update a disc product.
     * 
     * @param DiscProduct $product The product to update.
     * @param int $product_id The id of the product to update.
     * 
     * @access public
     * @return void
     */
    public function update(DiscProduct $product, int $product_id) {
        /**
         * query string for getting a product by id.
         * 
         * @var string $query
         */
        $query = '
            UPDATE product_disc
            size = :size,
            unit = :unit
            WHERE product_id = :id
        ';

        /**
         * Statement that prepares a database with the given query.
         * 
         * @var PDOStatement $stmt
         */
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized size for the query.
         * 
         * @var float $size
         */
        $size = filter_input(
            INPUT_POST,
            number_format($product->getSize(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the size to the query.
         */
        $stmt->bindParam(':size', $size, \PDO::PARAM_STR);

        /**
         * Sanitized unit for the query.
         * 
         * @var string $unit
         */
        $unit = filter_input(
            INPUT_POST,
            $product->getUnit(),
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );

        /**
         * Binds the unit to the query.
         */
        $stmt->bindParam(':unit', $unit, \PDO::PARAM_STR);

        /**
         * Sanitized id for the query.
         * 
         * @var int $id
         */
        $id = filter_input(
            INPUT_POST,
            number_format($product_id, 0, '.', ''),
            FILTER_SANITIZE_NUMBER_INT
        );

        /**
         * Binds the id to the query.
         */
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();
    }

    // }}}
    // {{{ delete()

    /**
     * Delete a product.
     * 
     * @param DiscProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(int $product_id) {
        /**
         * query string for getting a product by id.
         * 
         * @var string $query
         */
        $query = 'DELETE FROM disc_product WHERE product_id = :id';

        /**
         * Statement that prepares a database with the given query.
         * 
         * @var PDOStatement $stmt
         */
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized id for the query.
         * 
         * @var int $id
         */
        $id = filter_input(
            INPUT_GET,
            number_format($product_id, 0, '.', ''),
            FILTER_SANITIZE_NUMBER_INT
        );

        /**
         * Binds the id to the query.
         */
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();
    }

    // }}}
    // {{{ create()

    /**
     * Create a disc product.
     * 
     * @param DiscProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(DiscProduct $product, int $product_id) {
        /**
         * query string for getting a product by id.
         * 
         * @var string $query
         */
        $query = '
        INSERT INTO product_disc (
                disc_id,
                product_id,
                size,
                unit
            )
            VALUES (
                :id,
                :product_id,
                :size,
                :unit
            )
        ';

        /**
         * Statement that prepares a database with the given query.
         * 
         * @var PDOStatement $stmt
         */
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized id for the query.
         * 
         * @var int $id
         */
        $id = filter_input(
            INPUT_POST,
            number_format($product->getId(), 0, '.', ''),
            FILTER_SANITIZE_NUMBER_INT
        );

        /**
         * Binds the id to the query.
         */
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        /**
         * Sanitized size for the query.
         * 
         * @var float $size
         */
        $size = filter_input(
            INPUT_POST,
            number_format($product->getSize(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the size to the query.
         */
        $stmt->bindParam(':size', $size, \PDO::PARAM_STR);

        /**
         * Sanitized unit for the query.
         * 
         * @var string $unit
         */
        $unit = filter_input(
            INPUT_POST,
            $product->getUnit(),
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );

        /**
         * Binds the unit to the query.
         */
        $stmt->bindParam(':unit', $unit, \PDO::PARAM_STR);

        /**
         * Sanitized product id for the query.
         */
        $product_id = filter_input(
            INPUT_POST,
            number_format($product_id, 0, '.', ''),
            FILTER_SANITIZE_NUMBER_INT
        );

        /**
         * Binds the product id to the query.
         */
        $stmt->bindParam(':product_id', $product_id, \PDO::PARAM_INT);

        $stmt->execute();
    }

    // }}}
}

// }}}
