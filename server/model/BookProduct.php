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
include_once 'SymbolInterface.php';

// {{{ constants

/**
 * Enum for weight symbols.
 */
enum Weight implements SymbolInterface
{
  case KILOGRAMS;
  case POUNDS;

  // {{{ getSymbol()

  /**
   * Get the symbol for the weight.
   */
  public function getSymbol(): string
  {
    return match ($this) {
      /**
       * kilograms
       */
      Weight::KILOGRAMS => 'kg',

      /**
       * pounds
       */
      Weight::POUNDS => 'lbs',
    };
  }

  // }}}
}

// }}}
// {{{ BookProduct

/**
 * Class for book product objects.
 */
class BookProduct extends AbstractProduct
{
  // {{{ properties

  /**
   * Weight of the product.
   * 
   * @var string
   */
  public $weight;

  /**
   * unit of the product.
   * 
   * @var Weight
   */
  public $unit;

  // }}}
  // {{{ __construct

  public function __construct($id, $sku, $name, $price, $type, $weight)
  {
    parent::__construct($id, $sku, $name, $price, $type);
    $this->weight = $weight;
    $this->unit = new Weight('KILOGRAMS');
  }

  // }}}
  // {{{ setUnit

  /**
   * Set the unit of the product.
   * 
   * @param string $unit
   *  The unit of the product.
   * 
   * @return void
   * @access public
   */
  public function setUnit($unit): void
  {
    $this->unit = new Weight($unit);
  }
  
  // }}}
  // {{{ getContent

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
    {$this->type}: {$this->weight}{$this->unit}
    ";
  }

  // }}}
}

// }}}
