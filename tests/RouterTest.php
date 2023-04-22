<?php

declare(strict_types=1);

if (php_sapi_name() !== 'cli') {
    echo "<h1>Test only in CLI mode</h1>";
    exit;
}

use PHPUnit\Framework\TestCase;
use TRouter\Http\Router;
use TRouter\Controllers\HelloWorldController;

final class RouterTest extends TestCase
{

    private Router $router;

    public function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }

    final public function testAddAndGetHandlers(): void
    {
        $this->router->get('/test', 'callback1');
        $this->router->post('/test','callback2');

        $handlers = $this->router->getHandlers();

        $this->assertCount(2, $handlers);
        $this->assertArrayHasKey('GET/test', $handlers);
        $this->assertArrayHasKey('POST/test', $handlers);
    }

    /**
     * @throws ReflectionException
     */
    public function testRouteWithStaticMethod(): void
    {
        $this->expectOutputString('Hello World from Static Controller');
        $this->router->get('/test-static', HelloWorldController::class, 'testStatic');

        $_SERVER['REQUEST_URI'] = '/test-static';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $this->router->run();
    }

    /**
     * @throws ReflectionException
     */
    final public function testRouteWithInstanceMethod(): void
    {
        $this->expectOutputString('Hello World from instance controller');

        $this->router->get('/test-instance', HelloWorldController::class, 'testInstance');

        $_SERVER['REQUEST_URI'] = '/test-instance';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $this->router->run();
    }
}
