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
interface FurnitureProductMapperInterface
{
    // {{{ get()

    /**
     * Get a furniture product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return FurnitureProduct The product.
     */
    public function get(int $id): FurnitureProduct;

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
    public function update(FurnitureProduct $product);

    // }}}
    // {{{ delete()

    /**
     * Delete a furniture product.
     * 
     * @param FurnitureProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(FurnitureProduct $product);

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
    public function create(FurnitureProduct $product);
}

// }}}
// {{{ FurnitureProductMapper

/**
 * Class for furniture product objects.
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
     * Get a furniture product by id.
     * 
     * @param int $id The id of the product to find.
     * 
     * @access public
     * @return FurnitureProduct The product.
     */
    public function get(int $id): FurnitureProduct
    {
        $query = "SELECT * FROM furniture_products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            die("Record not found");
        }

        return FurnitureProduct::fromState($result);
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
    public function update(FurnitureProduct $product)
    {
        $query = "UPDATE furniture_products SET sku = ?, name = ?, price = ?, currency = ?, type = ?, width = ?, height = ?, length = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getWidth(),
            $product->getHeight(),
            $product->getLength(),
            $product->getId()
        ]);
    }

    // }}}
    // {{{ delete()

    /**
     * Delete a furniture product.
     * 
     * @param FurnitureProduct $product The product to delete.
     * 
     * @access public
     * @return void
     */
    public function delete(FurnitureProduct $product)
    {
        $query = "DELETE FROM furniture_products WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$product->getId()]);
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
    public function create(FurnitureProduct $product)
    {
        $query = "INSERT INTO furniture_products (id, sku, name, price, currency, type, width, height, length) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $product->getId(),
            $product->getSku(),
            $product->getName(),
            $product->getPrice(),
            $product->getCurrency(),
            $product->getType(),
            $product->getWidth(),
            $product->getHeight(),
            $product->getLength()
        ]);
    }

    // }}}
}

// }}}
