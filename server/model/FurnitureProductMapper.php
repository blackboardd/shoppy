<?php

/**
 * Furniture product data mapper.
 *
 * PHP version 8.1
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */

declare(strict_types=1);

namespace Shoppy\Model\Product;

// {{{ FurnitureProductMapperInterface

/**
 * Interface for furniture product mapper objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
interface FurnitureProductMapperInterface
{
    // {{{ get()

    /**
     * Get a furniture product by id.
     *
     * @param int $product_id The id of the product to find.
     *
     * @access public
     * @return FurnitureProduct The product.
     */
    public function get(int $product_id): FurnitureProduct;

    // }}}
    // {{{ update()

    /**
     * Update a furniture product.
     *
     * @param FurnitureProduct $product    The product to update.
     * @param int              $product_id The id of the product to update.
     *
     * @access public
     * @return void
     */
    public function update(FurnitureProduct $product, int $product_id);

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
     * Create a furniture product.
     *
     * @param FurnitureProduct $product    The product to create.
     * @param int              $product_id The id of the product to create.
     *
     * @access public
     * @return void
     */
    public function create(FurnitureProduct $product, int $product_id);
}

// }}}
// {{{ FurnitureProductMapper

/**
 * Class for furniture product objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
class FurnitureProductMapper implements FurnitureProductMapperInterface
{
    // {{{ __construct()

    /**
     * Constructor.
     *
     * @param PDO $db The database connection.
     *
     * @access public
     * @return void
     */
    public function __construct(private \PDO $db)
    {
    }

    // }}}
    // {{{ get()

    /**
     * Get a product by id.
     *
     * @param int $product_id The id of the product to find.
     *
     * @access public
     * @return FurnitureProduct The product.
     */
    public function get(int $product_id): FurnitureProduct
    {
        /**
         * Query string for getting a product by id.
         *
         * @var string $query
         */
        $query = 'SELECT * FROM furniture_product WHERE product_id = :id';

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

        return FurnitureProduct::fromState($result);
    }

    // }}}
    // {{{ update()

    /**
     * Update a furniture product.
     *
     * @param FurnitureProduct $product    The product to update.
     * @param int              $product_id The id of the product to update.
     *
     * @access public
     * @return void
     */
    public function update(FurnitureProduct $product, int $product_id)
    {
        /**
         * Query string for getting a product by id.
         *
         * @var string $query
         */
        $query = '
            UPDATE product_furniture
            width = :width,
            height = :height,
            length = :length,
            WHERE product_id = :id
        ';

        /**
         * Statement that prepares a database with the given query.
         *
         * @var PDOStatement $stmt
         */
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized width for the query.
         *
         * @var float $width
         */
        $width = filter_input(
            INPUT_POST,
            number_format($product->getWidth(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the width to the query.
         */
        $stmt->bindParam(':width', $width, \PDO::PARAM_STR);

        /**
         * Sanitized height for the query.
         *
         * @var float $height
         */
        $height = filter_input(
            INPUT_POST,
            number_format($product->getHeight(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the height to the query.
         */
        $stmt->bindParam(':height', $height, \PDO::PARAM_STR);

        /**
         * Sanitized length for the query.
         *
         * @var float $length
         */
        $length = filter_input(
            INPUT_POST,
            number_format($product->getLength(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the length to the query.
         */
        $stmt->bindParam(':length', $length, \PDO::PARAM_STR);

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
     * @param int $product_id The id of the product to delete.
     *
     * @access public
     * @return void
     */
    public function delete(int $product_id)
    {
        /**
         * Query string for getting a product by id.
         *
         * @var string $query
         */
        $query = 'DELETE FROM furniture_product WHERE product_id = :id';

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
     * Create a furniture product.
     *
     * @param FurnitureProduct $product    The product to create.
     * @param int              $product_id The id of the product to create.
     *
     * @access public
     * @return void
     */
    public function create(FurnitureProduct $product, int $product_id)
    {
        /**
         * Query string for getting a product by id.
         *
         * @var string $query
         */
        $query = '
        INSERT INTO product_furniture (
                furniture_id,
                product_id,
                width,
                height,
                length
            )
            VALUES (
                :id,
                :product_id,
                :width,
                :height,
                :length
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
         * Sanitized width for the query.
         *
         * @var float $width
         */
        $width = filter_input(
            INPUT_POST,
            number_format($product->getWidth(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the size to the query.
         */
        $stmt->bindParam(':width', $width, \PDO::PARAM_STR);

        /**
         * Sanitized height for the query.
         *
         * @var float $height
         */
        $height = filter_input(
            INPUT_POST,
            number_format($product->getHeight(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the height to the query.
         */
        $stmt->bindParam(':height', $height, \PDO::PARAM_STR);

        /**
         * Sanitized length for the query.
         *
         * @var float $length
         */
        $length = filter_input(
            INPUT_POST,
            number_format($product->getLength(), 2, '.', ''),
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION
        );

        /**
         * Binds the length to the query.
         */
        $stmt->bindParam(':length', $length, \PDO::PARAM_STR);

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
