<?php

/**
 * Abstract request class.
 *
 * PHP version 8.1
 *
 * LICENSE: MIT
 *
 * @category   Server
 * @package    Server
 * @author     Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright  2022 Brighten Tompkins
 * @license    https://opensource.org/licenses/MIT MIT
 */

namespace Server;

// {{{ AbstractRequest

/**
 * Abstract class for handling requests.
 */
abstract class AbstractRequest {
    // {{{ getBody()

    /**
     * Get the request body.
     * 
     * @access public
     */
    abstract public function getBody();

    // }}}
}

// }}}
