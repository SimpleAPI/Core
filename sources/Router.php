<?php
/**
 * Router
 *
 * PHP Version 5.4
 *
 * @category Router
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */

namespace SimpleAPI\Core;

use SimpleAPI\Core\Exceptions\FrameworkException;
use SimpleAPI\Core\Exceptions\NotFoundException;

/**
 * Class Router
 *
 * @category Router
 * @package  Core
 * @author   Antoine Knockaert <antoine.knockaert@epitech.eu>
 * @license  MIT
 * @link     https://github.com/SimpleAPI
 */
class Router
{
    /**
     * Instance of AltoRouter used by this class
     *
     * @var AltoRouter
     */
    private $altoRouter;

    /**
     * Current instance
     *
     * @var Router
     */
    protected static $instance;

    /**
     * The default constructor
     */
    protected function __construct()
    {
        $this->altoRouter = new \AltoRouter();
        if (isset(Configuration::$config['router.base.path']) && !empty(Configuration::$config['router.base.path'])) {
            $this->altoRouter->setBasePath(Configuration::$config['router.base.path']);
        }
    }

    /**
     * The default magic clone method (Copy constructor)
     *
     * @codeCoverageIgnore
     */
    protected function __clone()
    {
    }

    /**
     * Singleton method
     *
     * @return Router The instanciated router
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Add a route to the router
     *
     * @param string $path   The path to route
     * @param array  $target An associative array. Ex: array('c' => 'YourController', 'a' => 'YourAction);
     * @param string $method The HTTP method to route
     */
    public static function addRoute($path, $target, $method = 'GET')
    {
        $router = Router::getInstance();
        $router->altoRouter->map($method, $path, $target);
    }

    /**
     * This function runs the router and call the apropriate
     */
    public function run($url = null, $method = null)
    {
        $route = $this->altoRouter->match($url, $method);
        if (!$route) {
            throw new NotFoundException(((isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : ($url != null) ? $url : "") . ' is not reachable');
        }
        if (!isset($route['target']['c']) || !isset($route['target']['a']) || !isset($route['params'])) {
            throw new FrameworkException('Internal Framework Error. [!BAD_ROUTER_TARGET]', 001);
        }
        if (is_callable(array($route['target']['c'], 'getInstance'))) {
            $controller = $route['target']['c']::getInstance();
            if (method_exists($controller, $route['target']['a'])) {
                call_user_func(array($controller, $route['target']['a']), array_values($route['params']));
                $controller->response->send();
            } else {
                throw new FrameworkException('Internal Framework Error. [METHOD_DOES_NOT_EXISTS]', 002);
            }
        } else {
            throw new FrameworkException('Internal Framework Error. [CONTROLLER_DOES_NOT_EXISTS]', 003);
        }
    }
}