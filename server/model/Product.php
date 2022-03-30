<?php

/**
 * Product class.
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

namespace Shoppy\Model;

use Dotenv\Repository\Adapter\AdapterInterface;
use JsonSerializable;

require_once 'ProductFactory.php';

// {{{ Product

/**
 * Class for product objects.
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
class Product implements ProductFactory, JsonSerializable
{
    // {{{ properties

    /**
     * The product's id.
     *
     * This is also used as the SKU.
     *
     * @var    int
     * @access private
     */
    private $_id;

    /**
     * The product's SKU.
     *
     * @var    string
     * @access private
     */
    private $_sku;

    /**
     * The product's name.
     *
     * @var    string
     * @access private
     */
    private $_name;

    /**
     * The product's price.
     *
     * @var    float
     * @access private
     */
    private $_price;

    /**
     * The product's currency.
     *
     * @var    string
     * @access private
     */
    private $_currency;

    /**
     * The product's type.
     *
     * @var    string
     * @access private
     */
    private $_type;

    /**
     * The product's unit.
     *
     * @var string
     */
    private $_unit;

    /**
     * The product's unit value.
     *
     * @var int
     */
    private $_unitValue;

    // }}}
    // {{{ fromState

    /**
     * Create a furniture product from a state.
     *
     * @param array $state The state to create the product from.
     *
     * @return Product The product.
     * @access public
     * @static
     */
    public static function fromState(array $state): Product
    {
        return new self(
            $state['product_id'],
            $state['sku'],
            $state['name'],
            $state['price'],
            $state['currency'],
            $state['type'],
            $state['unit'],
            $state['unit_value']
        );
    }

    // }}}
    // {{{ createTable()

    /**
     * Create the product table.
     *
     * @param PDO $db The database to create the table in.
     *
     * @access public
     * @return void
     */
    public static function createTable(\PDO $db)
    {
        $query = '
        CREATE TABLE IF NOT EXISTS product (
            product_id INTEGER PRIMARY KEY,
            sku TEXT NOT NULL,
            name TEXT NOT NULL,
            price REAL NOT NULL,
            currency TEXT NOT NULL,
            type TEXT NOT NULL,
            unit TEXT NOT NULL,
            unit_value REAL NOT NULL
        )
        ';

        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    // }}}
    // {{{ __construct()

    /**
     * Constructor for the furniture product.
     *
     * @param int    $_id        The product's id.
     * @param string $_sku       The product's SKU.
     * @param string $_name      The product's name.
     * @param float  $_price     The product's price.
     * @param string $_currency  The product's currency.
     * @param string $_type      The product's type.
     * @param string $_unit      The product's unit.
     * @param string $_unitValue The product's unit value.
     *
     * @return void
     * @access public
     */
    public function __construct(
        int    $_id,
        string $_sku,
        string $_name,
        float  $_price,
        string $_currency,
        string $_type,
        string $_unit,
        float  $_unitValue
    ) {
        $this->_id = $_id;
        $this->_sku = $_sku;
        $this->_name = $_name;
        $this->_price = $_price;
        $this->_currency = $_currency;
        $this->_type = $_type;
        $this->_unit = $_unit;
        $this->_unitValue = $_unitValue;
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
    public function getId(): int
    {
        return $this->_id;
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
        return $this->_sku;
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
        return $this->_name;
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
        return $this->_price;
    }

    // }}}
    // {{{ getCurrency()

    /**
     * Get the product's currency.
     *
     * @return string The product's currency.
     * @access public
     */
    public function getCurrency(): string
    {
        return $this->_currency;
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
        return $this->_type;
    }

    // }}}
    // {{{ getUnit()

    /**
     * Get the product's unit.
     *
     * @return string The product's unit.
     * @access public
     */
    public function getUnit(): string
    {
        return $this->_unit;
    }

    // }}}
    // {{{ getUnitValue()

    /**
     * Get the product's unit value.
     *
     * @return float The product's unit value.
     * @access public
     */
    public function getUnitValue(): float
    {
        return $this->_unitValue;
    }

    /**
     * Get the product's json serialization.
     *
     * @return array The product's json serialization.
     * @access public
     * @see    JsonSerializable::jsonSerialize()
     * @link   https://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'sku' => $this->getSku(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'currency' => $this->getCurrency(),
            'type' => $this->getType(),
            'unit' => $this->getUnit(),
            'unit_value' => $this->getUnitValue()
        ];
    }

    // }}}
}

// }}}
