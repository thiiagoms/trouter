<?php

declare(strict_types=1);

namespace TRouter\Http;

use Closure;
use ReflectionMethod;
use TRouter\Helpers\Render;
use TRouter\Enums\HttpCode;

/**
 * Class Router
 *
 * The Router class handles the routing of incoming HTTP requests to the appropriate handler function.
 *
 * @package TRouter\Http
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.1
 */
final class Router
{
    /**
     * @var array An array of all registered request handlers.
     */
    private array $handlers = [];

    /**
     * Adds a new request handler to the handlers array.
     *
     * @param string          $http    The HTTP method used for the request.
     * @param string          $url     The URL of the request.
     * @param string|Closure  $handler The callback function for the request.
     * @param string|null     $method  The HTTP method used for the request. (optional)
     *
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
     * Adds a new GET request handler to the handlers array.
     *
     * @param string          $url     The URL of the request.
     * @param string|Closure  $handler The callback function for the request.
     * @param string|null     $method  The HTTP method used for the request. (optional)
     *
     * @return void
     */
    public function get(string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->addHandler('GET', $url, $handler, $method);
    }

    /**
     * Adds a new POST request handler to the handlers array.
     *
     * @param string          $url     The URL of the request.
     * @param string|Closure  $handler The callback function for the request.
     * @param string|null     $method  The HTTP method used for the request. (optional)
     *
     * @return void
     */
    public function post(string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->addHandler('POST', $url, $handler, $method);
    }

    /**
     * Adds a new PUT request handler to the handlers array.
     *
     * @param string          $url     The URL of the request.
     * @param string|Closure  $handler The callback function for the request.
     * @param string|null     $method  The HTTP method used for the request. (optional)
     *
     * @return void
     */
    public function put(string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->addHandler('PUT', $url, $handler, $method);
    }

    /**
     * Adds a new DELETE request handler to the handlers array.
     *
     * @param string          $url     The URL of the request.
     * @param string|Closure  $handler The callback function for the request.
     * @param string|null     $method  The HTTP method used for the request. (optional)
     *
     * @return void
     */
    public function delete(string $url, string|Closure $handler, ?string $method = null): void
    {
        $this->addHandler('DELETE', $url, $handler, $method);
    }

    /**
     * Check if the given method of the specified controller is a static method
     *
     * @param string $controller The name of the controller class
     * @param string $method The name of the method to check
     * @return bool Returns true if the method is static, false otherwise
     * @throws \ReflectionException If the controller or method cannot be found
     */
    private function isStatic(string $controller, string $method): bool
    {
        return (new ReflectionMethod($controller, $method))->isStatic();
    }

    /**
     * Execute Router
     *
     * @return void
     * @throws \ReflectionException
     */
    public function run(): void
    {
        try {
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
        } catch (\ReflectionException $e) {
            die("Error in TRouter core: {$e->getMessage()}");
        }
    }
}
