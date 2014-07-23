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
     * Halt the current framework execution by throwing a HTTP error + message
     *
     * @param int    $code          The HTTP code to use for the response
     * @param string $error_message The error message
     *
     * @throws StopException
     */
    public function halt($code, $error_message)
    {
        Bootloader::setResponse($code, json_encode(array('error' => $error_message)));
        throw new StopException();
    }

}