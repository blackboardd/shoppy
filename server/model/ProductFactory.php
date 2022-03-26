<?php

/**
 * Abstract class for product objects.
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

namespace Model\Product;

use Model\Symbol;

// {{{ constants

/**
 * Enum for currency symbols.
 */
enum Currency implements Symbol
{
    case USD;
    case EUR;
    case GBP;

    // {{{ getSymbol()

    /**
     * Get the symbol for the currency.
     */
    public function getSymbol(): string
    {
        return match ($this) {
            /**
             * United States Dollar
             */
            Currency::USD => '$',

            /**
             * Euro
             */
            Currency::EUR => '€',

            /**
             * British Pound
             */
            Currency::GBP => '£',
        };
    }

    // }}}
}

// }}}
// {{{ ProductFactory

/**
 * Factory for product objects.
 */
interface ProductFactory
{
    // {{{ getId()
    
    /**
     * Get the product's id.
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
     * @return Currency The product's currency.
     * @access public
     */
    public function getCurrency(): Currency;

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
