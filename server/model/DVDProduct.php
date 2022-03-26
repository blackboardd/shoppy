<?php

/**
 * Abstract class for product objects.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Product
 * @package    model\product
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

namespace model\product;

include_once 'AbstractProduct.php';

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
// {{{ AbstractProduct

/**
 * Class for DVD product objects.
 */
class DVDProduct extends AbstractProduct
{
    // {{{ properties

    /**
     * Size of the product.
     * 
     * @var float
     */
    public $size;

    /**
     * Unit of the product.
     * 
     * @var Size
     */
    public $unit;

    // }}}
    // {{{ getSymbol()

    /**
     * Construct a DVD product.
     * 
     * @param int $id The product's id.
     * @param string $sku The product's SKU.
     * @param string $name The product's name.
     * @param float $price The product's price.
     * @param string $type The product's type.
     * @param float $size The product's size.
     * 
     * @return void
     * @access public
     */
    public function __construct($id, $sku, $name, $price, $type, $size)
    {
        parent::__construct($id, $sku, $name, $price, $type);
        $this->size = $size;
        
        /**
         * Sets the default unit.
         */
        $this->unit = new Size('MEGABYTES');
    }

    // }}}
    // {{{ setUnit()

    /**
     * Set the unit of the product.
     * 
     * @param Size $unit
     * @return void
     * @access public
     */
    public function setUnit($unit)
    {
        $this->unit = new Weight($unit);
    }

    // }}}
    // {{{ getContent()
    
    /**
     * Get the content of the product.
     * 
     * @return string
     * @access public
     */
    public function getContent(): string
    {
        return "
    {$this->sku}
    {$this->name}
    {$this->currency}{$this->price}
    {$this->type}: {$this->size}{$this->unit}
    ";
    }

    // }}}
}

// }}}
