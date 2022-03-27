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

namespace Shoppy\Model\Product;

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
}

// }}}
