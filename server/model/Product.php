<?php

/**
 * Product class.
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

include_once 'ProductFactory.php';

// {{{ Product

/**
 * Class for product objects. 
 */
class Product implements ProductFactory {
    // {{{ fromState

    /**
     * Create a furniture product from a state.
     * 
     * @param array $state The state to create the product from.
     * @return Product The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): Product {
        return new self(
            $state['id'],
            $state['name'],
            $state['price'],
            $state['currency'],
            $state['type']
        );
    }

    // }}}
    // {{{ __construct()

    /**
     * Constructor for the furniture product.
     * 
     * @param int $id The product's id.
     * @param string $name The product's name.
     * @param float $price The product's price.
     * @param string $currency The product's currency.
     * @param string $type The product's type.
     * 
     * @return void
     * @access public
     */
    public function __construct(
        private int $id,
        private string $name,
        private float $price,
        private string $currency,
        private string $type
    ) {
    }

    // }}}
    // {{{ getId()

    /**
     * Get the product's id.
     *
     * This is also used as the SKU.
     *
     * @return int The product's id.
     * @access public
     */
    public function getId(): int {
        return $this->id;
    }

    // }}}
    // {{{ getName()

    /**
     * Get the product's name.
     * 
     * @return string The product's name.
     * @access public
     */
    public function getName(): string {
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
    public function getPrice(): float {
        return $this->price;
    }

    // }}}
    // {{{ getCurrency()

    /**
     * Get the product's currency.
     * 
     * @return string The product's currency.
     * @access public
     */
    public function getCurrency(): string {
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
    public function getType(): string {
        return $this->type;
    }

    // }}}
}

// }}}
