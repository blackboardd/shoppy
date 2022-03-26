<?php

/**
 * Furniture product data mapper.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Product
 * @package    Model\Product
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Model\Product;

// {{{ FurnitureProductMapperInterface

/**
 * Interface for furniture product mapper objects.
 */
interface FurnitureProductMapperInterface {
    // {{{ update()

    /**
     * Update a furniture product.
     * 
     * @param FurnitureProduct $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(FurnitureProduct $product);

    // }}}
    // {{{ create()

    /**
     * Create a furniture product.
     * 
     * @param FurnitureProduct $product The product to create.
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
 */
class FurnitureProductMapper implements FurnitureProductMapperInterface {
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
    // {{{ update()

    /**
     * Update a furniture product.
     * 
     * @param FurnitureProduct $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(FurnitureProduct $product) {
        $query = "
            UPDATE product_furniture
            width = ?,
            height = ?,
            length = ?
            WHERE furniture_id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getWidth(),
            $product->getHeight(),
            $product->getLength(),
            $product->getId()
        ]);
    }

    // }}}
    // {{{ create()

    /**
     * Create a furniture product.
     * 
     * @param FurnitureProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(FurnitureProduct $product, int $product_id) {
        $query = "
        INSERT INTO product_furniture (
            furniture_id,
            product_id,
            width,
            height,
            length) VALUES (?, ?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product_id,
            $product->getWidth(),
            $product->getHeight(),
            $product->getLength()
        ]);
    }

    // }}}
}

// }}}
