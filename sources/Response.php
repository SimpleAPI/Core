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

    }

}