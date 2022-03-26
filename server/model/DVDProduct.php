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

// {{{ DVDProduct

/**
 * Class for DVD product objects.
 */
class DVDProduct {
    // {{{ fromState

    /**
     * Create a DVD product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return DVDProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): DVDProduct {
        return new self(
            $state['dvd_id'],
            $state['size'],
            $state['unit']
        );
    }

    // }}}
    // {{{ __construct

    /**
     * Construct a DVD product.
     * 
     * @param int $dvd_id The product's id.
     * @param float $size The product's size.
     * @param string $unit The product's size unit.
     * 
     * @return void
     * @access public
     */
    public function __construct(
        private int $dvd_id,
        private float $size,
        private string $unit
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
        return $this->dvd_id;
    }

    // }}}
    // {{{ getSize()

    /**
     * Get the product's size.
     *
     * @return float The product's size.
     * @access public
     */
    public function getSize(): float {
        return $this->size;
    }

    // }}}
    // {{{ getUnit()

    /**
     * Get the product's size unit.
     *
     * @return string The product's size unit.
     * @access public
     */
    public function getUnit(): string {
        return $this->unit;
    }

    // }}}
}

// }}}
