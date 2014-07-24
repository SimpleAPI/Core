<?php
/**
 * Bootloader
 *
 * PHP Version 5.4
 *
 * @category Bootloader
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core;

/**
 * Class Bootloader
 *
 * @category Bootloader
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class Bootloader
{

    /**
     * Register the framework autoloader to php
     */
    private static function registerAutoloader()
    {
        spl_autoload_register(array('\SimpleAPI\Core\Autoloader', 'autoload'));
    }

    private static function handlePHPErrors() {
        if (isset(Configuration::$config['mode']) && Configuration::$config['mode'] == "development") {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
        }
    }

    /**
     * Add headers for access control origin to the response
     */
    private static function checkAllowedOrigin()
    {
//        if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], Configuration::$config['security.allowedDomains'])) {
//            self::$response->setHeader('Access-Control-Allow-Headers', $_SERVER['HTTP_ORIGIN']);
//            self::$response->setHeader('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
//            self::$response->setHeader('Access-Control-Allow-Credentials', 'true');
//            self::$response->setHeader('Access-Control-Allow-Headers', $_SERVER['HTTP_ORIGIN']);
//        }
//        self::$response->setHeader('Access-Control-Allow-Methods', 'GET,POST');
    }

    public static function boot() {
        self::registerAutoloader();
        self::handlePHPErrors();
    }

}