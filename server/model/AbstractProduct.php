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

include_once 'SymbolInterface.php';

// {{{ constants

/**
 * Enum for currency symbols.
 */
enum Currency implements SymbolInterface
{
  case USD;
  case EUR;
  case GBP;

  /**
   * Get the symbol for the currency.
   */
  public function getSymbol(): string
  {
    return match ($this) {
      /**
       * United States Dollar
       */
      Currency::USD => '$',

      /**
       * Euro
       */
      Currency::EUR => '€',

      /**
       * British Pound
       */
      Currency::GBP => '£',
    };
  }
}

// }}}
// {{{ AbstractProduct

/**
 * Abstract class for product objects.
 */
abstract class AbstractProduct
{
  // {{{ properties
  
  /**
   * Product ID.
   *
   * @var int
   */
  public $id;

  /**
   * Product SKU.
   * 
   * @var string
   */
  public $sku;

  /**
   * Product name.
   * 
   * @var string
   */
  public $name;

  /** 
   * Product price.
   * 
   * @var float
   */
  public $price;

  /**
   * Product currency.
   * 
   * @var Currency
   */
  public $currency;

  /**
   * Product type.
   * 
   * @var string
   */
  public $type;

  // }}}
  // {{{ __construct

  /**
   * Construct a product.
   * 
   * @param int $id
   * @param string $sku
   * @param string $name
   * @param float $price
   * @param string $type
   * 
   * @return void
   * @access public
   */
  public function __construct($id, $sku, $name, $price, $type)
  {
    /**
     * Initialize the product.
     */
    $this->id = $id;
    $this->sku = $sku;
    $this->name = $name;
    $this->price = $price;
    $this->type = $type;

    /**
     * Set the default currency.
     */
    self::$currency = new Currency('USD');
  }

  // }}}
  // {{{ setCurrency

  /**
   * Set the currency.
   * 
   * @param Currency $currency
   * 
   * @return void
   * @access public
   * @static
   */
  public static function setCurrency($currency): void
  {
    self::$currency = new Currency($currency);
  }

  // }}}
  // {{{ getContent

  /**
   * Get the content of the product.
   * 
   * @return string
   * @access public
   * @abstract
   */
  abstract public function getContent(): string;

  // }}}
}

// }}}
