<?php

/**
 * Disc product class.
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

// {{{ DiscProduct

/**
 * Class for disc product objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
class DiscProduct
{
    // {{{ fromState

    /**
     * Create a disc product from a state.
     *
     * @param array $state The state to create the product from.
     *
     * @return DiscProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): DiscProduct
    {
        return new self(
            $state['disc_id'],
            $state['size'],
            $state['unit']
        );
    }

    // }}}
    // {{{ __construct

    /**
     * Construct a disc product.
     *
     * @param int    $disc_id The product's id.
     * @param float  $size    The product's size.
     * @param string $unit    The product's size unit.
     *
     * @return void
     * @access public
     */
    public function __construct(
        private int $disc_id,
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
    public function getId(): int
    {
        return $this->disc_id;
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
     * @return string The product's size unit.
     * @access public
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    // }}}
}

// }}}
