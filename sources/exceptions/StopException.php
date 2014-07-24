<?php
/**
 * Stop Exception
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

/**
 * Class StopException
 *
 * @category Exception
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class StopException extends HTTPException
{

    public function __construct($code, $message, $error_code = null) {
        parent::__construct($code, $message, $error_code);
    }
}