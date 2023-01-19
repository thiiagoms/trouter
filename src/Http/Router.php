<?php

declare(strict_types=1);

namespace TRouter\Http;

use Closure;
use ReflectionMethod;
use TRouter\Helpers\Render;
use TRouter\Enums\HttpCode;

/**
 * Router package
 *
 * @package Src\Http
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
final class Router
{
    /**
     * Store HTTP Code, Controller|Callback and methods
     *
     * @var array[]
     */
    private array $handlers = [];

    /**
     * Add in handler,  HTTP Request Code, Callback and method (can be null)
     *
     * @param string $http
     * @param string $url
     * @param string|Closure $handler
     * @param string|null $method
     * @return void
     */
    private function addHandler(string $http, string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->handlers[$http . $url] = [
            'http'    => $http,
            'path'    => $url,
            'handler' => $handler,
            'method'  => $method
        ];
    }

    /**
     * GET Request
     *
     * @param string $url
     * @param string|Closure $handler
     * @param string|null $method
     * @return void
     */
    public function get(string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->addHandler('GET', $url, $handler, $method);
    }

    /**
     * Post Request
     *
     * @param string $url
     * @param string|Closure $handler
     * @return void
     */
    public function post(string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->addHandler('POST', $url, $handler, $method);
    }


    public function put()
    {
        // TODO
    }

    public function delete()
    {
        // TODO.
    }

    /**
     * Check if method of controller class is static or not
     *
     * @param string $controller
     * @param string $method
     * @return boolean
     */
    private function isStatic(string $controller, string $method): bool
    {
        return (new ReflectionMethod($controller, $method))->isStatic();
    }

    /**
     * Execute Router
     *
     * @return void
     */
    public function run(): void
    {
        $requestURI    = parse_url($_SERVER['REQUEST_URI']);
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath   = $requestURI['path'];

        $callback = null;
        $method  = null;

        foreach ($this->handlers as $handler) {
            if ($handler['path'] === $requestPath && $requestMethod === $handler['http']) {
                $callback = $handler['handler'];
                $method = !is_null($handler['method']) ? $handler['method'] : null;
            }
        }

        if (!$callback) {
            header('HTTP/1.0 404 Not Found');
            echo Render::render('404');
            return;
        }

        if (is_string($callback)) {
            # For static methods
            if ($this->isStatic($callback, $method)) {
                http_response_code(HttpCode::SUCCESS->getCode());
                $callback::$method();
                return;
            }

            # For instance methods
            if (!is_null($method)) {
                http_response_code(HttpCode::SUCCESS->getCode());
                (new $callback())->$method();
                return;
            }
        }

        # Execute callback
        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}
