<?php

declare(strict_types=1);

namespace TRouter\Controllers;

/**
 * Controller example
 *
 * @package TRouter\Controllers
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
final class HelloWorldController
{
    /**
     * Test with instance method
     *
     * @return void
     */
    public function testInstance(): void
    {
        echo 'Hello World from instance controller';
    }

    /**
     * Test with static method
     *
     * @return void
     */
    public static function testStatic(): void
    {
        echo 'Hello World from Static Controller';
    }
}
