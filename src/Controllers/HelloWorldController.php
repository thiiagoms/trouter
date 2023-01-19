<?php

declare(strict_types=1);

namespace TRouter\Controllers;

final class HelloWorldController
{
    public static function hello(): string
    {
        return 'Hello World';
    }
}
