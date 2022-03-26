<?php

/**
 * Furniture product class.
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

// {{{ FurnitureProduct

/**
 * Class for furniture product objects. 
 */
class FurnitureProduct implements ProductFactory
{
    // {{{ fromState

    /**
     * Create a furniture product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return FurnitureProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): FurnitureProduct
    {
        return new self(
            $state['id'],
            $state['sku'],
            $state['name'],
            $state['price'],
            $state['currency'],
            $state['type'],
            $state['width'],
            $state['height'],
            $state['length'],
        );
    }

    // }}}
    // {{{ __construct()

    /**
     * Constructor for the furniture product.
     * 
     * @param int $id The product's id.
     * @param string $sku The product's SKU.
     * @param string $name The product's name.
     * @param float $price The product's price.
     * @param Currency $currency The product's currency.
     * @param string $type The product's type.
     * @param float $width The product's width.
     * @param float $height The product's height.
     * @param float $length The product's length.
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
        private float $width,
        private float $height,
        private float $length
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
    // {{{ getWidth()

    /**
     * Get the product's width.
     * 
     * @return float The product's width.
     * @access public
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    // }}}
    // {{{ getHeight()

    /**
     * Get the product's height.
     * 
     * @return float The product's height.
     * @access public
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    // }}}
    // {{{ getLength()

    /**
     * Get the product's length.
     * 
     * @return float The product's length.
     * @access public
     */
    public function getLength(): float
    {
        return $this->length;
    }

    // }}}
}

// }}}
