<?php

/**
 * Book product class.
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

include_once 'ProductFactory.php';
include_once 'Symbol.php';

// {{{ constants

/**
 * Enum for weight symbols.
 */
enum Weight implements Symbol
{
    case KILOGRAMS;
    case POUNDS;

    // {{{ getSymbol()

    /**
     * Get the symbol for the weight.
     */
    public function getSymbol(): string
    {
        return match ($this) {
            /**
             * kilograms
             */
            Weight::KILOGRAMS => 'kg',

            /**
             * pounds
             */
            Weight::POUNDS => 'lbs',
        };
    }

    // }}}
}

// }}}
// {{{ BookProduct

/**
 * Class for book product objects.
 */
class BookProduct implements ProductFactory
{
    // {{{ fromState

    /**
     * Create a book product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return DVDProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): BookProduct
    {
        return new self(
            $state['id'],
            $state['sku'],
            $state['name'],
            $state['price'],
            $state['currency'],
            $state['type'],
            $state['weight'],
            $state['unit']
        );
    }

    // }}}
    // {{{ __construct

    /**
     * Construct a book product.
     * 
     * @param int $id The product's id.
     * @param string $sku The product's SKU.
     * @param string $name The product's name.
     * @param float $price The product's price.
     * @param Currency $currency The product's currency.
     * @param string $type The product's type.
     * @param float $weight The product's weight.
     * @param Weight $unit The product's weight unit.
     * 
     * @return void
     * @access public
     */
    public function __construct(
        private int $id,
        private string $sku,
        private string $name,
        private float $price,
        private Currency $currency,
        private string $type,
        private float $weight,
        private Weight $unit
    ) {
    }

    // }}}
    // {{{ getId()

    /**
     * Get the product's id.
     * 
     * @return int The product's id.
     * @access public
     */
    public function getId(): int
    {
        return $this->id;
    }

    // }}}
    // {{{ getSku()

    /**
     * Get the product's SKU.
     * 
     * @return string The product's SKU.
     * @access public
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    // }}}
    // {{{ getName()

    /**
     * Get the product's name.
     * 
     * @return string The product's name.
     * @access public
     */
    public function getName(): string
    {
        return $this->name;
    }

    // }}}
    // {{{ getPrice()

    /**
     * Get the product's price.
     * 
     * @return float The product's price.
     * @access public
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    // }}}
    // {{{ getCurrency()

    /**
     * Get the product's currency.
     * 
     * @return Currency The product's currency.
     * @access public
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    // }}}
    // {{{ getType()

    /**
     * Get the product's type.
     * 
     * @return string The product's type.
     * @access public
     */
    public function getType(): string
    {
        return $this->type;
    }

    // }}}
    // {{{ getWeight()

    /**
     * Get the product's weight.
     * 
     * @return float The product's weight.
     * @access public
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    // }}}
    // {{{ getUnit()

    /**
     * Get the product's weight unit.
     * 
     * @return Weight The product's weight unit.
     * @access public
     */
    public function getUnit(): Weight
    {
        return $this->unit;
    }

    // }}}
}

// }}}
