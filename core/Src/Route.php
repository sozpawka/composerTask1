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

    public function __construct(string $prefix = '')
    {
        self::setPrefix($prefix);
    }

    public static function add(string $route, array $action): void
    {
        if (!array_key_exists($route, self::$routes)) {
            self::$routes[$route] = $action;
        }
    }

   public function redirect(string $url): void
   {
       header('Location: ' . $this->getUrl($url));
       exit;
   }

  public function start(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);
        if (isset($segments[0]) && $segments[0] === 'pop-it-mvc') {
            array_shift($segments);
        }

        if (isset($segments[0]) && $segments[0] === 'public') {
            array_shift($segments);
        }
        $uri = implode('/', $segments);

        if (!array_key_exists($uri, self::$routes)) {
            throw new Error("This path does not exist: $uri");
        }

        $class = self::$routes[$uri][0];
        $action = self::$routes[$uri][1];

        call_user_func([new $class, $action], new \Src\Request());
    }
    public function getUrl(string $url): string
    {
        $base = self::$prefix ?: 'pop-it-mvc';
        $url = trim($url, '/');
        return '/' . trim($base, '/') . ($url ? '/' . $url : '');
    }
}