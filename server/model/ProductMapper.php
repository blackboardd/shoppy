<?php

/**
 * Product data mapper.
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

namespace Shoppy\Model;

require_once 'Product.php';

// {{{ ProductMapperInterface

/**
 * Interface for product mapper objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
interface ProductMapperInterface
{
    // {{{ getAll()

    /**
     * Get all products.
     *
     * @access public
     * @return array The products.
     */
    public function getAll(): array;

    // }}}
    // {{{ get()

    /**
     * Get a furniture product by id.
     *
     * @param int $id The id of the product to find.
     *
     * @access public
     * @return Product The product.
     */
    public function get(int $id): Product;

    // }}}
    // {{{ update()

    /**
     * Update a product.
     *
     * @param Product $product The product to update.
     *
     * @access public
     * @return void
     */
    public function update(Product $product);

    // }}}
    // {{{ delete()

    /**
     * Delete a product.
     *
     * @param int $productId The id of the product to delete.
     *
     * @access public
     * @return void
     */
    public function delete(int $productId);

    // }}}
    // {{{ deleteAll()

    /**
     * Delete all products.
     *
     * @access public
     * @return void
     */
    public function deleteAll();

    // }}}
    // {{{ create()

    /**
     * Create a product.
     *
     * @param Product $product The product to create.
     *
     * @access public
     * @return void
     */
    public function create(Product $product);
}

// }}}
// {{{ ProductMapper

/**
 * Class for product objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
class ProductMapper implements ProductMapperInterface
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
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    // }}}
    // {{{ getAll()

    /**
     * Get all products.
     *
     * @access public
     * @return array The products.
     */
    public function getAll(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM products');
        $stmt->execute();
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $products;
    }

    // }}}
    // {{{ get()

    /**
     * Get a product by id.
     *
     * @param int $id The id of the product to find.
     *
     * @access public
     * @return Product The product.
     */
    public function get(int $id): Product
    {
        $query = 'SELECT * FROM products WHERE product_id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            die('Record not found');
        }

        return Product::fromState($result);
    }

    // }}}
    // {{{ update()

    /**
     * Update a product.
     *
     * @param Product $product The product to update.
     *
     * @access public
     * @return void
     */
    public function update(Product $product)
    {
        $query = '
            UPDATE products
            SET sku = :sku,
            name = :name,
            price = :price,
            currency = :currency,
            type = :type,
            unit = :unit,
            unit_value = :unitValue
            WHERE product_id = :id
        ';
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized product id.
         *
         * @var int $id
         */
        $id = $product->getId();
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        $params = [
            ':sku' => $product->getSku(),
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':currency' => $product->getCurrency(),
            ':type' => $product->getType(),
            ':unit' => $product->getUnit(),
            ':unitValue' => $product->getUnitValue(),
            ':id' => $id
        ];

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
    }

    // }}}
    // {{{ delete()

    /**
     * Delete a product.
     *
     * @param int $productId The id of the product to delete.
     *
     * @access public
     * @return void
     */
    public function delete(int $productId)
    {
        $query = 'DELETE FROM products WHERE product_id = :id';
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized product id.
         *
         * @var int $id
         */
        $id = filter_var($productId, FILTER_SANITIZE_NUMBER_INT);

        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    // }}}
    // {{{ deleteAll()

    /**
     * Delete all products.
     *
     * @access public
     * @return void
     */
    public function deleteAll()
    {
        $query = 'DELETE FROM products';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    }

    // }}}
    // {{{ create()

    /**
     * Create a product.
     *
     * @param Product $product The product to create.
     *
     * @access public
     * @return void
     */
    public function create(Product $product)
    {
        $query = '
        INSERT INTO products (
            product_id,
            sku,
            name,
            price,
            currency,
            type,
            unit,
            unit_value
        ) VALUES (:id, :sku, :name, :price, :currency, :type, :unit, :unit_value)
        ';
        $stmt = $this->db->prepare($query);

        /**
         * Sanitized product id.
         *
         * @var int $id
         */
        $id = filter_var($product->getId(), FILTER_SANITIZE_NUMBER_INT);

        // Bind parameters to the statement.
        $params = [
            ':id' => $id,
            ':sku' => $product->getSku(),
            ':name' => $product->getName(),
            ':price' => $product->getPrice(),
            ':currency' => $product->getCurrency(),
            ':type' => $product->getType(),
            ':unit' => $product->getUnit(),
            ':unit_value' => $product->getUnitValue()
        ];

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
    }

    // }}}
}

// }}}
