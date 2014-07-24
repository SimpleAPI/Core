<?php
/**
 * NotFound Exception
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
 * Class NotFoundException
 *
 * @category Exception
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class NotFoundException extends HTTPException
{

    public function __construct($message) {
        parent::__construct(404, $message, null);
    }
}