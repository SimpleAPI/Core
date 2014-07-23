<?php
/**
 * Autoloader
 *
 * PHP Version 5.4
 *
 * @category Autoloader
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core;

/**
 * Class Autoloader
 *
 * @category Autoloader
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class Autoloader
{

    /**
     * Load a controller by requiring it files
     *
     * @param string $class The class name
     *
     * @return void
     */
    private static function loadController($class)
    {
        if (file_exists(CONTROLLERS . $class . '.php')) {
            include_once CONTROLLERS . $class . '.php';
        }
    }


    /**
     * Load a model by requiring it files
     *
     * @param string $class The class name
     *
     * @return void
     */
    private static function loadModel($class)
    {
        if (file_exists(MODELS . $class . '.php')) {
            include_once MODELS . $class . '.php';
        }
    }

    /**
     * Load a helper by requiring it files
     *
     * @param string $class The class name
     *
     * @return void
     */
    private static function loadHelper($class)
    {
        if (file_exists(HELPERS . $class . '.php')) {
            include_once HELPERS . $class . '.php';
        }
    }

    /**
     * Global framework autoloader (Compares the filename to include the right file)
     *
     * @param string $class The class name
     *
     * @return void
     */
    public static function autoload($class)
    {
        if (substr($class, -10) == "Controller") {
            self::loadController($class);
        } else if (substr($class, -5) == "Model") {
            self::loadModel($class);
        } else if (substr($class, -6) == "Helper") {
            self::loadHelper($class);
        }
    }

} 