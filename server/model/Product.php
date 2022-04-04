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
     * @var string
     */
    private $_unitValue;

    // }}}
    // {{{ fromState

    /**
     * Create a product from a state.
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
        CREATE TABLE IF NOT EXISTS products (
            product_id INTEGER PRIMARY KEY,
            sku TEXT NOT NULL,
            name TEXT NOT NULL,
            price REAL NOT NULL,
            currency TEXT NOT NULL,
            type TEXT NOT NULL,
            unit TEXT NOT NULL,
            unit_value TEXT NOT NULL
        )
        ';

        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    // }}}
    // {{{ dropTable()

    /**
     * Drop the product table.
     *
     * @param PDO $db The database to drop the table from.
     *
     * @access public
     * @return void
     */
    public static function dropTable(\PDO $db)
    {
        $query = 'DROP TABLE IF EXISTS products';

        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    // }}}
    // {{{ createTestData()

    /**
     * Create test data.
     *
     * @param PDO $db The database to create the test data in.
     *
     * @access public
     * @return void
     */
    public static function createTestData(\PDO $db)
    {
        $query = '
        INSERT INTO products (
            product_id,
            sku,
            name,
            price,
            currency,
            type,
            unit,
            unit_value
        ) VALUES (
            :product_id,
            :sku,
            :name,
            :price,
            :currency,
            :type,
            :unit,
            :unit_value
        )
        ';

        $stmt = $db->prepare($query);

        $stmt->execute(
            [
            ':product_id' => 1,
            ':sku' => '30544275E04DC6F7',
            ':name' => 'Run, Rose, Run: A Novel',
            ':price' => 18.00,
            ':currency' => 'USD',
            ':type' => 'BOOK',
            ':unit' => 'KILOGRAMS',
            ':unit_value' => '0.67'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 2,
            ':sku' => 'D48F823638D2827C',
            ':name' => 'Loveseat Sofa Gray Fabric',
            ':price' => 399.99,
            ':currency' => 'USD',
            ':type' => 'FURNITURE',
            ':unit' => 'INCHES',
            ':unit_value' => '30.7x66.5x30.7'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 3,
            ':sku' => 'F5FB3F28BC08239F',
            ':name' => 'Verbatim CD-R Blank Discs',
            ':price' => 16.88,
            ':currency' => 'USD',
            ':type' => 'DISC',
            ':unit' => 'MEGABYTES',
            ':unit_value' => '700'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 4,
            ':sku' => '7F88E5E990D6B08D',
            ':name' => 'Maxell 625335 Lifetime Warranty',
            ':price' => 15.30,
            ':currency' => 'USD',
            ':type' => 'DISC',
            ':unit' => 'MEGABYTES',
            ':unit_value' => '700'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 5,
            ':sku' => 'E5481B3899D2F07B',
            ':name' => 'Where the Crawdads Sing',
            ':price' => 12.40,
            ':currency' => 'USD',
            ':type' => 'BOOK',
            ':unit' => 'KILOGRAMS',
            ':unit_value' => '0.59'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 6,
            ':sku' => '90F3BBB4C0A5271A',
            ':name' => 'My Dear Little One',
            ':price' => 16.99,
            ':currency' => 'USD',
            ':type' => 'BOOK',
            ':unit' => 'KILOGRAMS',
            ':unit_value' => '0.79'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 7,
            ':sku' => '73C6FAC669A06CA8',
            ':name' => 'The Very Hungry Caterpillar',
            ':price' => 5.06,
            ':currency' => 'USD',
            ':type' => 'BOOK',
            ':unit' => 'KILOGRAMS',
            ':unit_value' => '0.18'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 8,
            ':sku' => '17F10071582536F8',
            ':name' => '5 Drawer Dresser Industrial Gray',
            ':price' => 104.99,
            ':currency' => 'USD',
            ':type' => 'FURNITURE',
            ':unit' => 'INCHES',
            ':unit_value' => '11.7x24.6x38.4'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 9,
            ':sku' => '3E01A5E372ED6616',
            ':name' => 'Upholstered Leather Sofa',
            ':price' => 360.50,
            ':currency' => 'USD',
            ':type' => 'FURNITURE',
            ':unit' => 'INCHES',
            ':unit_value' => '32x53x35'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 10,
            ':sku' => '9F459862646D6C8C',
            ':name' => 'Digitech DVD CD-RW',
            ':price' => 13.24,
            ':currency' => 'USD',
            ':type' => 'DISC',
            ':unit' => 'MEGABYTES',
            ':unit_value' => '400'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 11,
            ':sku' => '1F9CB74BF1C2D07C',
            ':name' => 'The Flames of Hope',
            ':price' => 12.60,
            ':currency' => 'USD',
            ':type' => 'BOOK',
            ':unit' => 'KILOGRAMS',
            ':unit_value' => '0.45'
            ]
        );

        $stmt->execute(
            [
            ':product_id' => 12,
            ':sku' => 'FD0B912FD364D168',
            ':name' => 'Blueberry Muffin Ottoman',
            ':price' => 1099.00,
            ':currency' => 'USD',
            ':type' => 'FURNITURE',
            ':unit' => 'INCHES',
            ':unit_value' => '74x101x33'
            ]
        );
    }

    // }}}
    // {{{ __construct()

    /**
     * Constructor for the product.
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
        string $_unitValue
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
     * @return string The product's unit value.
     * @access public
     */
    public function getUnitValue(): string
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
