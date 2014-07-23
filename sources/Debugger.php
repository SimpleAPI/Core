<?php
/**
 * Debugger
 *
 * PHP Version 5.4
 *
 * @category Debugger
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core;

/**
 * Class Debugger
 *
 * @category Debugger
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class Debugger
{

    /**
     * Debug data with a print_r formatted call
     *
     * @param mixed $data The data to pass to print_r
     *
     * @return void
     */
    public static function debug($data)
    {
        self::print_r($data);
    }

    /**
     * Formatted print_r function for HTML views
     *
     * @param mixed $data The data to pass to print_r
     *
     * @return void
     */
    public static function print_r($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * Formatted var_dump function for HTML views
     *
     * @param mixed $data The data to pass to var_dump
     *
     * @return void
     */
    public static function var_dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

} 