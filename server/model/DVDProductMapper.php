<?php

/**
 * DVD product data mapper.
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

// {{{ DVDProductMapperInterface

/**
 * Interface for DVD product mapper objects.
 */
interface DVDProductMapperInterface {
    // {{{ get()

    /**
     * Get a DVD product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return DVDProduct The product.
     */
    public function get(int $id): DVDProduct;

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
    public function update(DVDProduct $product);

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
    // {{{ get()

    /**
     * Get a product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return DVDProduct The product.
     */
    public function get(int $id): DVDProduct {
        $query = "SELECT * FROM dvd_product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            die("Record not found");
        }

        return DVDProduct::fromState($result);
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
    // {{{ delete()

    /**
     * Delete a product.
     * 
     * @param DVDProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(int $product_id) {
        $query = "DELETE FROM dvd_product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product_id]);
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
            unit) VALUES (?, ?, ?, ?)
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
