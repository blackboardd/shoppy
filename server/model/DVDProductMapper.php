<?php

/**
 * DVD product data mapper.
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

// {{{ DVDProductMapperInterface

/**
 * Interface for DVD product mapper objects.
 */
interface DVDProductMapperInterface {
    // {{{ update()

    /**
     * Update a DVD product.
     * 
     * @param DVDProduct $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(DVDProduct $product);

    // }}}
    // {{{ create()

    /**
     * Create a DVD product.
     * 
     * @param DVDProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(DVDProduct $product, int $product_id);
}

// }}}
// {{{ DVDProductMapper

/**
 * Class for DVD product objects.
 */
class DVDProductMapper implements DVDProductMapperInterface {
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
     * Update a DVD product.
     * 
     * @param DVDProduct $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(DVDProduct $product) {
        $query = "
            UPDATE product_dvd
            size = ?,
            unit = ?
            WHERE dvd_id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getSize(),
            $product->getUnit(),
            $product->getId()
        ]);
    }

    // }}}
    // {{{ create()

    /**
     * Create a DVD product.
     * 
     * @param DVDProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(DVDProduct $product, int $product_id) {
        $query = "
        INSERT INTO product_dvd (
            dvd_id,
            product_id,
            size,
            unit) VALUES (?, ?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product_id,
            $product->getSize(),
            $product->getUnit()
        ]);
    }

    // }}}
}

// }}}
