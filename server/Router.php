<?php

/**
 * Router class.
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

// {{{ Router

/**
 * Class for handling requests.
 */
class Router {
    // {{{ properties
    /**
     * Supported routes.
     * 
     * @var array $supportedHttpMethods
     */
    private $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    // }}}
    // {{{ __construct()

    /**
     * Construct a router.
     * 
     * @param mixed $request
     * 
     * @access public
     * @return void
     */
    public function __construct(private mixed $request) {
    }

    // }}}
    // {{{ __call()

    /**
     * Handle a request.
     * 
     * @param string $name
     * @param array $args
     * 
     * @access public
     * @return void
     */
    public function __call($name, $args) {
        // Get the request method
        list($route, $method) = $args;

        // Check if the request method is supported
        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        // Check if the route is supported
        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }
    
    // }}}
    // {{{ formatRoute()

    /**
     * Removes trailing forward slashes from the right of the route.
     *
     * @param string $route The route to format.
     * 
     * @access private
     * @return string The formatted route.
     */
    private function formatRoute($route) {
        /**
         * Result of the route with trailing forward slashes removed.
         * 
         * @var string $result
         */
        $result = rtrim($route, '/');

        // Check if the route is empty.
        if ($result === '') {
            return '/';
        }

        return $result;
    }

    // }}}
    // {{{ invalidMethodHandler()
    
    /**
     * Handle an invalid request method.
     * 
     * @access private
     * @return void
     */
    private function invalidMethodHandler() {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    // }}}
    // {{{ defaultRequestHandler()

    /**
     * Handle a default request.
     * 
     * @access private
     * @return void
     */
    private function defaultRequestHandler() {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    // }}}
    // {{{ resolve()

    /**
     * Resolves a route.
     * 
     * @access public
     * @return void;
     */
    public function resolve() {
        /**
         * The request method.
         * 
         * @var string $methodDictionary
         */
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};

        /**
         * The formatted route.
         * 
         * @var string $fRoute
         */
        $fRoute = $this->formatRoute($this->request->requestUri);

        /**
         * The method to call.
         * 
         * @var string $method
         */
        $method = $methodDictionary[$fRoute];

        // Check if the method exists.
        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        // Call the method.
        echo call_user_func_array($method, array($this->request));
    }

    // }}}
    // {{{ __destruct()

    /**
     * Destruct a router.
     * 
     * @access public
     * @return void
     */
    function __destruct() {
        $this->resolve();
    }

    // }}}
}

// }}}
