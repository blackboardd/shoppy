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
interface DVDProductMapperInterface
{
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
     * Delete a DVD product.
     * 
     * @param DVDProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(DVDProduct $product);

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
    public function create(DVDProduct $product);
}

// }}}
// {{{ DVDProductMapper

/**
 * Class for DVD product objects.
 */
class DVDProductMapper implements DVDProductMapperInterface
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
     * Get a DVD product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return DVDProduct The product.
     */
    public function get(int $id): DVDProduct
    {
        $query = "SELECT * FROM dvd_products WHERE id = ?";
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
    public function update(DVDProduct $product)
    {
        $query = "UPDATE dvd_products SET sku = ?, name = ?, price = ?, currency = ?, type = ?, size = ?, unit = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getSize(),
            $product->getUnit()
        ]);
    }
    
    // }}}
    // {{{ delete()

    /**
     * Delete a DVD product.
     * 
     * @param DVDProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(DVDProduct $product)
    {
        $query = "DELETE FROM dvd_products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product->getId()]);
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
    public function create(DVDProduct $product)
    {
        $query = "INSERT INTO dvd_products (id, sku, name, price, currency, type, size, unit) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getSize(),
            $product->getUnit()
        ]);
    }

    // }}}
}

// }}}
