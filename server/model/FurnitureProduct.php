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

// {{{ FurnitureProduct

/**
 * Class for furniture product objects. 
 */
class FurnitureProduct extends AbstractProduct
{
    // {{{ properties
    
    /**
     * The product's height.
     * 
     * @var float
     */
    public $height;

    /**
     * The product's width.
     * 
     * @var float
     */
    public $width;

    /**
     * The product's length.
     * 
     * @var float
     */
    public $length;

    // }}}
    // {{{ __construct()

    /**
     * Constructor for the furniture product.
     * 
     * @param int $id The product's id.
     * @param string $sku The product's SKU.
     * @param string $name The product's name.
     * @param float $price The product's price.
     * @param string $type The product's type.
     * @param float $height The product's height.
     * @param float $width The product's width.
     * @param float $length The product's length.
     * 
     * @return void
     * @access public
     */
    public function __construct(
        $id,
        $sku,
        $name,
        $price,
        $type,
        $height,
        $width,
        $length
    ) {
        parent::__construct($id, $sku, $name, $price, $type);
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    // }}}
    // {{{ getContent()

    /**
     * Get the content of the product.
     * 
     * @return string
     * The content of the product.
     * 
     * @access public
     */
    public function getContent(): string
    {
        return "
    {$this->sku}
    {$this->name}
    {$this->currency}{$this->price}
    {$this->type}: {$this->height}x{$this->width}x{$this->length}
    ";
    }

    // }}}
}
// }}}
