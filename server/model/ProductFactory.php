<?php

/**
 * Abstract class for product objects.
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

namespace Shoppy\Model;

// {{{ ProductFactory

/**
 * Factory for product objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
interface ProductFactory
{
    // {{{ fromState

    /**
     * Create a product from a state.
     *
     * @param array $state The state to create the product from.
     *
     * @return Product The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): Product;
    
    // }}}
    // {{{ createTable()
    
    /**
     * Create the product table.
     *
     * @param PDO $db The database to create the table in.
     *
     * @access public
     * @return void
     */
    public static function createTable(\PDO $db);

    // }}}
    // {{{ dropTable()
    
    /**
     * Drop the product table.
     *
     * @param PDO $db The database to drop the table from.
     *
     * @access public
     * @return void
     */
    public static function dropTable(\PDO $db);

    // }}}
    // {{{ createTestData()
    
    /**
     * Create test data.
     *
     * @param PDO $db The database to create the test data in.
     *
     * @access public
     * @return void
     */
    public static function createTestData(\PDO $db);

    // }}}
    // {{{ getId()

    /**
     * Get the product's id.
     *
     * This is also used as the SKU.
     *
     * @return int The product's id.
     * @access public
     */
    public function getId(): int;

    // }}}
    // {{{ getSku()

    /**
     * Get the product's SKU.
     *
     * @return string The product's SKU.
     * @access public
     */
    public function getSku(): string;

    // }}}
    // {{{ getName()

    /**
     * Get the product's name.
     *
     * @return string The product's name.
     * @access public
     */
    public function getName(): string;

    // }}}
    // {{{ getPrice()

    /**
     * Get the product's price.
     *
     * @return float The product's price.
     * @access public
     */
    public function getPrice(): float;

    // }}}
    // {{{ getCurrency()

    /**
     * Get the product's currency.
     *
     * @return string The product's currency.
     * @access public
     */
    public function getCurrency(): string;

    // }}}
    // {{{ getType()

    /**
     * Get the product's type.
     *
     * @return string The product's type.
     * @access public
     */
    public function getType(): string;

    // }}}
    // {{{ getUnit()

    /**
     * Get the product's unit.
     *
     * @return string The product's unit.
     * @access public
     */
    public function getUnit(): string;

    // }}}
    // {{{ getUnitValue()

    /**
     * Get the product's unit value.
     *
     * @return string The product's unit value.
     * @access public
     */
    public function getUnitValue(): string;

    // }}}
}

// }}}
