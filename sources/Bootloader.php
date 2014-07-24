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
    public static function registerAutoloader()
    {
        spl_autoload_register(array('\SimpleAPI\Core\Autoloader', 'autoload'));
    }

    /**
     * Add headers for access control origin to the response
     */
    private static function checkAllowedOrigin()
    {
        if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], Configuration::$config['security.allowedDomains'])) {
            self::$response->setHeader('Access-Control-Allow-Headers', $_SERVER['HTTP_ORIGIN']);
            self::$response->setHeader('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
            self::$response->setHeader('Access-Control-Allow-Credentials', 'true');
            self::$response->setHeader('Access-Control-Allow-Headers', $_SERVER['HTTP_ORIGIN']);
        }
        self::$response->setHeader('Access-Control-Allow-Methods', 'GET,POST');
    }

    /**
     * Add headers to the response
     */
    private static function setHeaders()
    {
        self::$response->setHeader('Content-Type', 'text/html; charset=utf-8');
        self::$response->setHeader('Pragma', 'no-cache');
        self::$response->setHeader('Cache-Control', 'no-cache, must-revalidate');
        self::$response->setHeader('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        self::$response->setHeader('Content-type', 'application/json');
    }

    /**
     * Send the response to the client if not already sent
     */
    public static function render()
    {
        Bootloader::checkAllowedOrigin();
        Bootloader::setHeaders();
        \Sabre\HTTP\Sapi::sendResponse(self::$response);
    }

}