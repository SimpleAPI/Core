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

use SimpleAPI\Core\Exceptions\FrameworkException;
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

    /**
     * @var \SimpleApi\Interfaces\IResponse The response to send
     */
    private $code = 200;

    private $body = "";

    private $headers = array();

    private static $messages = array(
        // [Informational 1xx]
        100 => '100 Continue',
        101 => '101 Switching Protocols',
        // [Successful 2xx]
        200 => '200 OK',
        201 => '201 Created',
        202 => '202 Accepted',
        203 => '203 Non-Authoritative Information',
        204 => '204 No Content',
        205 => '205 Reset Content',
        206 => '206 Partial Content',
        // [Redirection 3xx]
        300 => '300 Multiple Choices',
        301 => '301 Moved Permanently',
        302 => '302 Found',
        303 => '303 See Other',
        304 => '304 Not Modified',
        305 => '305 Use Proxy',
        306 => '306 (Unused)',
        307 => '307 Temporary Redirect',
        // [Client Error 4xx]
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        402 => '402 Payment Required',
        403 => '403 Forbidden',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        406 => '406 Not Acceptable',
        407 => '407 Proxy Authentication Required',
        408 => '408 Request Timeout',
        409 => '409 Conflict',
        410 => '410 Gone',
        411 => '411 Length Required',
        412 => '412 Precondition Failed',
        413 => '413 Request Entity Too Large',
        414 => '414 Request-URI Too Long',
        415 => '415 Unsupported Media Type',
        416 => '416 Requested Range Not Satisfiable',
        417 => '417 Expectation Failed',
        // [Server Error 5xx]
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
        505 => '505 HTTP Version Not Supported'
    );

    public function __construct()
    {
    }

    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    public function getHeaders()
    {
        return ($this->headers);
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody($body)
    {
        return ($this->body);
    }

    public function setStatus($code)
    {
        $this->code = $code;
    }

    public function getStatus($code)
    {
        return ($this->code);
    }

    public function setResponse($code, $body = "")
    {
        $this->setStatus($code);
        if (!empty($body)) {
            $this->setBody($body);
        }
    }

    public function getResponse()
    {
        return (array(
            'code' => $this->code,
            'body' => $this->body
        ));
    }

    public function send()
    {
        $this->finalize();

        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        if (isset(self::$messages[$this->code])) {
            header($protocol . ' ' . $this->code . ' ' . self::$messages[$this->code]);
        } else {
            throw new FrameworkException('Invalid status code set.', 003);
        }

        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value);
        }

        echo $this->body;
    }

    private function finalize()
    {
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