<?php

/**
 * Book product data mapper.
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

use Model\StorageAdapter;
use RecordNotFoundException;

// {{{ BookProductMapperInterface

/**
 * Interface for book product mapper objects.
 */
interface BookProductMapperInterface
{
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
     * Update a book product.
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
     * Delete a book product.
     * 
     * @param BookProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(BookProduct $product);

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
    public function create(BookProduct $product);
}

// }}}
// {{{ BookProductMapper

/**
 * Class for book product objects.
 */
class BookProductMapper implements BookProductMapperInterface
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
     * Get a book product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return BookProduct The product.
     */
    public function get(int $id): BookProduct
    {
        $query = "SELECT * FROM book_products WHERE id = ?";
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
    public function update(BookProduct $product)
    {
        $query = "UPDATE book_products SET sku = ?, name = ?, price = ?, currency = ?, type = ?, weight = ?, unit = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getWeight(),
            $product->getUnit(),
            $product->getId()
        ]);
    }
    
    // }}}
    // {{{ delete()

    /**
     * Delete a book product.
     * 
     * @param BookProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(BookProduct $product)
    {
        $query = "DELETE FROM book_products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product->getId()]);
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
    public function create(BookProduct $product)
    {
        $query = "INSERT INTO book_products (id, sku, name, price, currency, type, weight, unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getWeight(),
            $product->getUnit()
        ]);
    }

    // }}}
}

// }}}
