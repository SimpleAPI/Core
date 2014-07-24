<?php
/**
 * Controller
 *
 * PHP Version 5.4
 *
 * @category Controller
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core;

use SimpleAPI\Core\Exceptions\StopException;

/**
 * Class Controller
 *
 * @category Controller
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class Controller
{

    /**
     * @var \SimpleApi\Core\IResponse The response to send
     */
    public $response;

    /**
     *
     */
    protected function __construct()
    {
        $this->response = new Response();
    }

    /**
     * Halt the current framework execution by throwing a HTTP error + message
     *
     * @param int    $code          The HTTP code to use for the response
     * @param string $error_message The error message
     *
     * @throws StopException
     */
    public function halt($code, $error_message)
    {
        throw new StopException($code, $error_message);
    }

}