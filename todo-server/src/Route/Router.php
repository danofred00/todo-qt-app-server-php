<?php

namespace Todolist\Route;

use Todolist\Utils\Utils;

use function PHPUnit\Framework\assertIsCallable;

class Router
{
    /**
     * Represent all routes, a route is represented by
     *      + route
     *      + method
     *      + action
     */
    public static $routes = [];

    /**
     * Bind action to route
     */
    public static function bind(string $route, string $method, callable $action, mixed $args = null)
    {

        // we check if the action var is a function
        assertIsCallable($action, "The action passed is not a function");

        // create a array to push
        $_route = array(
            'route'     =>  $route,
            'method'    =>  $method,
            'action'    =>  $action
        );

        // push array
        array_push(Router::$routes, $_route);
    }

    public static function call($route, $method, array $args = null)
    {

        foreach(Router::$routes as $_route)
        {
            // change the default content-type
            header('Content-Type: application/json');

            // display the view
            if(($_route['route'] == $route) && strcasecmp($_route['method'], $method)==0)
            {
                $action = $_route['action'];

                if(! is_null($args))
                    echo json_encode($action(...$args));
                else
                    echo json_encode($action());
            
                return;
            }
        }
    }

    public static function routesName()
    {
        $routes = [];
        foreach (Router::$routes as $route) {
            array_push($routes, $route['route']);
        }

        return $routes;
    }

    public static function get($route, $action)
    {
        Router::bind($route, 'GET', $action);
    }

    public static function post($route, $action)
    {
        Router::bind($route, 'POST', $action);
    }

    public static function put($route, $action)
    {
        Router::bind($route, 'PUT', $action);
    }

    public static function delete($route, $action)
    {
        Router::bind($route, 'DELETE', $action);
    }

    public static function error404($route) : array
    {
        return [
            'error' => "Route $route not found",
        ];
    }
}