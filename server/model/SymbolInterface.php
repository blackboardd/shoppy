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

// {{{ SymbolInterface

/** 
 * Interface for symbols.
 */
interface SymbolInterface
{
  public function getSymbol(): string;
}

// }}}
