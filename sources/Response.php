<?php
/**
 * Bootloader
 *
 * PHP Version 5.4
 *
 * @category Response
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core;

use SimpleAPI\Core\Interfaces\IResponse;

/**
 * Class Response
 *
 * @category Response
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class Response implements IResponse
{

    public function __construct() {
        $this->setStatus(200);
        $this->setBody("");
    }

    public function setHeader($header, $value) {

    }

    public function getHeaders() {

    }

    public function setBody($body) {

    }

    public function getBody($body) {

    }

    public function setStatus($code) {

    }

    public function getStatus($code) {

    }

    public function setResponse($code, $body = "") {

    }

    public function getResponse() {

    }

    public function send() {
        $this->finalize();
    }

    private function finalize() {
        // Add headers here
        $this->setHeader('Content-Type', 'application/json; charset=utf-8');
        $this->setHeader('Pragma', 'no-cache');
        $this->setHeader('Cache-Control', 'no-cache, must-revalidate');
        $this->setHeader('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');

        if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], Configuration::$config['security.allowedDomains'])) {
            $this->setHeader('Access-Control-Allow-Headers', $_SERVER['HTTP_ORIGIN']);
            $this->setHeader('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
            $this->setHeader('Access-Control-Allow-Credentials', 'true');
            $this->setHeader('Access-Control-Allow-Headers', $_SERVER['HTTP_ORIGIN']);
        }
        $this->setHeader('Access-Control-Allow-Methods', 'GET,POST');
    }

}