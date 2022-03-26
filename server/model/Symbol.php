<?php

/**
 * Symbol interface for use with product objects.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Product
 * @package    Model
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

namespace Model;

// {{{ SymbolInterface

/** 
 * Interface for symbols.
 */
interface Symbol
{
    // {{{ getSymbol()
    public function getSymbol(): string;
    // }}}
}

// }}}
