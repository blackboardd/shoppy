<?php

/**
 * Request class.
 *
 * PHP version 8.1
 *
 * @category  Server
 * @package   Shoppy\Server
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */

namespace Shoppy\Server;

// {{{ AbstractRequest

/**
 * Abstract class for handling requests.
 *
 * @category  Server
 * @package   Shoppy\Server
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
abstract class AbstractRequest
{
    // {{{ getBody()

    /**
     * Get the request body.
     *
     * @access public
     * @return string The request body.
     */
    abstract public function getBody();

    // }}}
}

// }}}
// {{{ Request

/**
 * Class for handling requests.
 *
 * @category  Server
 * @package   Shoppy\Server
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
class Request extends AbstractRequest
{
    // {{{ __construct()

    /**
     * Construct a request.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->_bootstrapSelf();
    }

    // }}}
    // {{{ _bootstrapSelf()

    /**
     * Bootstrap the request.
     *
     * @access private
     * @return void
     */
    private function _bootstrapSelf()
    {
        // Get the request method
        foreach ($_SERVER as $key => $value) {
            $this->{$this->_toCamelCase($key)} = $value;
        }
    }

    // }}}
    // {{{ _toCamelCase()

    /**
     * Convert a string to camel case.
     *
     * @param string $string The string to convert.
     *
     * @return string The converted string.
     * @access private
     */
    private function _toCamelCase($string)
    {
        /**
         * Result of the string as lowercase
         *
         * @var string $result
         */
        $result = strtolower($string);

        // Replace all non-alphanumeric characters with a single underscore
        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    // }}}
    // {{{ getBody()

    /**
     * Get the request body.
     *
     * @access public
     * @return string The request body.
     */
    public function getBody()
    {
        if ($this->requestMethod === 'GET') {
            return;
        }

        if ($this->requestMethod === 'POST') {
            /**
             * Body initialized to empty array.
             *
             * @var array $body
             */
            $body = array();

            /**
             * Look through the $_POST array and add each value to the body.
             */
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(
                    INPUT_POST,
                    $key,
                    FILTER_SANITIZE_SPECIAL_CHARS
                );
            }

            return $body;
        }
    }

    // }}}
}

// }}}
