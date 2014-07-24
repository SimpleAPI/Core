<?php
/**
 * SimpleAPI Exception
 *
 * PHP Version 5.4
 *
 * @category Exception
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core\Exceptions;

use SimpleAPI\Core\Response;

/**
 * Class SimpleAPIException
 *
 * @category Exception
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class HTTPException extends \Exception
{

    /**
     * @var \SimpleApi\Core\IResponse The response to send
     */
    public $response;

    public function __construct($code, $message, $error_code)
    {
        $this->response = new Response();
        $this->response->setStatus($code);
        $this->response->setBody(json_encode([
            'error' => [
                'http_code'  => $code,
                'message'    => $message,
                'error_code' => $error_code
            ]
        ]));
    }

    public function render()
    {
        $this->response->send();
    }

}