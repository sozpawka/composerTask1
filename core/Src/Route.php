<?php

namespace Src;

use Error;

class Route
{
   private static array $routes = [];
   private static string $prefix = '';

   public static function setPrefix($value)
   {
       self::$prefix = $value;
   }

   public static function add(string $route, array $action): void
   {
       if (!array_key_exists($route, self::$routes)) {
           self::$routes[$route] = $action;
       }
   }

  public function start(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);
        if ($segments[0] === 'pop-it-mvc') {
            array_shift($segments);
        }

        $uri = $segments[0] ?? '';

        if ($uri === '') {
            $uri = 'go';
        }

        if (!array_key_exists($uri, self::$routes)) {
            throw new Error("This path does not exist: $uri");
        }

        $class = self::$routes[$uri][0];
        $action = self::$routes[$uri][1];

        call_user_func([new $class, $action]);
    }
}
