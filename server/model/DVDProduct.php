<?php

/**
 * DVD product class.
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

// {{{ constants

/**
 * Enum for size symbols.
 */
enum Size
{
    case KILOBYTES;
    case MEGABYTES;
    case GIGABYTES;

    // {{{ getSymbol()

    /**
     * Get the symbol for the size.
     */
    public function getSymbol(): string
    {
        return match ($this) {
            /**
             * kilobytes
             */
            Size::KILOBYTES => 'kbs',

            /**
             * megabytes
             */
            Size::MEGABYTES => 'mbs',

            /**
             * gigabytes
             */
            Size::GIGABYTES => 'gbs',
        };
    }

    // }}}
}

// }}}
// {{{ DVDProduct

/**
 * Class for DVD product objects.
 */
class DVDProduct implements ProductFactory
{
    // {{{ fromState
    
    /**
     * Create a DVD product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return DVDProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): DVDProduct
    {
        return new self(
            $state['id'],
            $state['sku'],
            $state['name'],
            $state['price'],
            $state['currency'],
            $state['type'],
            $state['size'],
            $state['unit']
        );
    }

    // }}}
    // {{{ __construct

    /**
     * Construct a DVD product.
     * 
     * @param int $id The product's id.
     * @param string $sku The product's SKU.
     * @param string $name The product's name.
     * @param float $price The product's price.
     * @param Currency $currency The product's currency.
     * @param string $type The product's type.
     * @param float $size The product's size.
     * @param Size $unit The product's size unit.
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
        private float $size,
        private Size $unit
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
        return new Currency($this->currency);
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
    // {{{ getSize()
    
    /**
     * Get the product's size.
     *
     * @return float The product's size.
     * @access public
     */
    public function getSize(): float
    {
        return $this->size;
    }

    // }}}
    // {{{ getUnit()
    
    /**
     * Get the product's size unit.
     *
     * @return Size The product's size unit.
     * @access public
     */
    public function getUnit(): Size
    {
        return new Size($this->unit);
    }

    // }}}
}

// }}}
