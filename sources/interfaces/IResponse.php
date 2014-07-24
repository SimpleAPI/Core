<?php

/**
 * IResponse
 *
 * PHP Version 5.4
 *
 * @category IResponse
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core\Interfaces;

/**
 * Interface IResponse
 *
 * @category IResponse
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
interface IResponse {

    public function setHeader($header, $value);
    public function getHeaders();

    public function setBody($body);
    public function getBody($body);

    public function setStatus($code);
    public function getStatus($code);

    public function setResponse($code, $body = "");
    public function getResponse();

    public function send();

}