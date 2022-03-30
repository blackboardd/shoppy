<?php

/**
 * Class to setup the database.
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

use Dotenv;
use PDOException;
use PDO;

// {{{ Database

/**
 * Class to set up the database
 *
 * @category  Server
 * @package   Shoppy\Server
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */

// {{{ Database

/**
 * Class to set up the database
 *
 * @category  Product
 * @package   Shoppy\Model\Product
 * @author    Brighten Tompkins <brightenqtompkins@gmail.com>
 * @copyright 2022 Brighten Tompkins
 * @license   https://opensource.org/licenses/MIT MIT
 * @link      https://bitbucket.org/blackboardd/shoppy
 */
class Database
{
    /**
     * Function to connect to database.
     *
     * @access public
     * @return PDO
     */
    public function connect(): PDO
    {
        /**
         * Create database connection using .env file.
         *
         * @var Dotenv $dotenv
         */
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        /**
         * Database name.
         *
         * @var string $database
         */
        $database = $_ENV['MYSQL_DATABASE'];

        /**
         * Database username.
         *
         * @var string $user
         */
        $user = 'root';

        /**
         * Database password.
         *
         * @var string $pass
         */
        $pass = $_ENV['MYSQL_ROOT_PASSWORD'];

        /**
         * Database host.
         *
         * @var string $host
         */
        $host = 'mysql';

        /**
         * Database schema name.
         *
         * @var string $dsn
         */
        $dsn = 'mysql:host=' . $host .';dbname=' . $database . ';charset=utf8mb4';

        /**
         * Database base handler.
         *
         * @var PDO $dbh
         */
        $dbh = new PDO($dsn, $user, $pass);

        // set the PDO error mode to exception.
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbh;
    }

    // }}}
}

// }}}
