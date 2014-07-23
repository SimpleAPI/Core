<?php
/**
 * Bootloader
 *
 * PHP Version 5.4
 *
 * @category Bootloader
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  GPL v3
 * @link     http://jenkins.knck.eu
 */

namespace SimpleAPI\Core;

/**
 * Class Bootloader
 *
 * @category Bootloader
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  GPL v3
 * @link     http://jenkins.knck.eu
 */
class Bootloader
{

    /**
     * The response to send
     *
     * @var Sabre\HTTP\Response
     */
    private static $response = null;

    public static function resetResponse() {
        self::$response = null;
    }

    /**
     * Register the framework autoloader to php
     */
    public static function registerAutoloader()
    {
        spl_autoload_register(array('Autoloader', 'autoload'));
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
     * Set the response
     *
     * @param integer $code The status code of the response
     * @param string $body The body of the response
     *
     * @internal param \Sabre\HTTP\Response $response The response which will be sent
     */
    public static function setResponse($code, $body = "") {
        if (Configuration::$config['mode'] === "production") {
            $body = ")]}',\n" . $body;
        }
        self::$response = new \Sabre\HTTP\Response($code, array(), $body);
    }

    /**
     * Return the current response
     *
     * @return \Sabre\HTTP\Response
     */
    public static function getResponse() {
        return self::$response;
    }

    /**
     * Send the response to the client if not already sent
     */
    public static function render()
    {
        if (!self::$response instanceof \Sabre\HTTP\ResponseInterface) {
            self::setResponse(500, json_encode(array('error' => 'Internal Framework Error. [NO_RESPONSE_SET]')));
        }
        Bootloader::checkAllowedOrigin();
        Bootloader::setHeaders();
        Sabre\HTTP\Sapi::sendResponse(self::$response);
    }

}