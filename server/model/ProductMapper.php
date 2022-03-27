<?php

/**
 * Product data mapper.
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

include_once 'Product.php';

// {{{ ProductMapperInterface

/**
 * Interface for product mapper objects.
 */
interface ProductMapperInterface {
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
     * @param Product $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(Product $product);

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
 * Class for furniture product objects.
 */
class ProductMapper implements ProductMapperInterface {
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
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return Product The product.
     */
    public function get(int $id): Product {
        $query = 'SELECT * FROM product WHERE product_id = ?';
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
     * Update a furniture product.
     * 
     * @param Product $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(Product $product) {
        $query = '
            UPDATE product
            name = ?,
            price = ?,
            currency = ?,
            type = ?
            WHERE product_id = ?
        ';
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getId()
        ]);
    }

    // }}}
    // {{{ delete()

    /**
     * Delete a product.
     * 
     * @param Product $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(Product $product) {
        $query = 'DELETE FROM product WHERE product_id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product->getId()]);
    }

    // }}}
    // {{{ create()

    /**
     * Create a furniture product.
     * 
     * @param Product $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(Product $product) {
        $query = '
        INSERT INTO product (
            product_id,
            name,
            price,
            currency,
            type
        ) VALUES (?, ?, ?, ?, ?)
        ';
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType()
        ]);
    }

    // }}}
}

// }}}
