<?php

/**
 * Furniture product class.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Product
 * @package    Shoppy\Model\Product
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

namespace Shoppy\Model\Product;

// {{{ FurnitureProduct

/**
 * Class for furniture product objects. 
 */
class FurnitureProduct {
    // {{{ fromState

    /**
     * Create a furniture product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return FurnitureProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): FurnitureProduct {
        return new self(
            $state['furniture_id'],
            $state['width'],
            $state['height'],
            $state['length']
        );
    }

    // }}}
    // {{{ __construct()

    /**
     * Constructor for the furniture product.
     * 
     * @param int $furniture_id The product's id.
     * @param float $width The product's width.
     * @param float $height The product's height.
     * @param float $length The product's length.
     * 
     * @return void
     * @access public
     */
    public function __construct(
        private int $furniture_id,
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
    public function getId(): int {
        return $this->furniture_id;
    }

    // }}}
    // {{{ getWidth()

    /**
     * Get the product's width.
     * 
     * @return float The product's width.
     * @access public
     */
    public function getWidth(): float {
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
    public function getHeight(): float {
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
    public function getLength(): float {
        return $this->length;
    }

    // }}}
}

// }}}
