<?php

/**
 * Book product data mapper.
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

// {{{ BookProductMapperInterface

/**
 * Interface for Book product mapper objects.
 */
interface BookProductMapperInterface {
    // {{{ get()

    /**
     * Get a book product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return BookProduct The product.
     */
    public function get(int $id): BookProduct;

    // }}}
    // {{{ update()

    /**
     * Update a Book product.
     * 
     * @param BookProduct $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(BookProduct $product);

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
     * Create a Book product.
     * 
     * @param BookProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(BookProduct $product, int $product_id);
}

// }}}
// {{{ BookProductMapper

/**
 * Class for book product objects.
 */
class BookProductMapper implements BookProductMapperInterface {
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
     * @return BookProduct The product.
     */
    public function get(int $id): BookProduct {
        $query = "SELECT * FROM book_product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            die("Record not found");
        }

        return BookProduct::fromState($result);
    }

    // }}}
    // {{{ update()

    /**
     * Update a book product.
     * 
     * @param BookProduct $product The product to update.
     * 
     * @access public
     * @return void
     */
    public function update(BookProduct $product) {
        $query = "
            UPDATE product_book
            weight = ?,
            unit = ?
            WHERE book_id = ?
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getWeight(),
            $product->getUnit(),
            $product->getId()
        ]);
    }

    // }}}
    // {{{ delete()

    /**
     * Delete a product.
     * 
     * @param BookProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(int $product_id) {
        $query = "DELETE FROM book_product WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product_id]);
    }

    // }}}
    // {{{ create()

    /**
     * Create a book product.
     * 
     * @param BookProduct $product The product to create.
     * 
     * @access public
     * @return void
     */
    public function create(BookProduct $product, int $product_id) {
        $query = "
        INSERT INTO product_book (
            book_id,
            product_id,
            weight,
            unit) VALUES (?, ?, ?, ?)
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product_id,
            $product->getWeight(),
            $product->getUnit()
        ]);
    }

    // }}}
}

// }}}
