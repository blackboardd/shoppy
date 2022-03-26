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

// {{{ BookProduct

/**
 * Class for book product objects.
 */
class BookProduct {
    // {{{ fromState

    /**
     * Create a book product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return BookProduct The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): BookProduct {
        return new self(
            $state['book_id'],
            $state['weight'],
            $state['unit']
        );
    }

    // }}}
    // {{{ __construct

    /**
     * Construct a book product.
     * 
     * @param int $book_id The product's id.
     * @param float $weight The product's weight.
     * @param string $unit The product's weight unit.
     * 
     * @return void
     * @access public
     */
    public function __construct(
        private int $book_id,
        private float $weight,
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
        return $this->book_id;
    }

    // }}}
    // {{{ getWeight()

    /**
     * Get the product's weight.
     * 
     * @return float The product's weight.
     * @access public
     */
    public function getWeight(): float {
        return $this->weight;
    }

    // }}}
    // {{{ getUnit()

    /**
     * Get the product's weight unit.
     * 
     * @return string The product's weight unit.
     * @access public
     */
    public function getUnit(): string {
        return $this->unit;
    }

    // }}}
}

// }}}
