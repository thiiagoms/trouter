<?php

declare(strict_types=1);

namespace TRouter\Enums;

/**
 * Enums for HTTP Code
 *
 * @package TRouter\Enums
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
enum HttpCode
{
    case SUCCESS;

    case SUCCESS_CREATE;

    case NOT_FOUND;

    case SERVER_ERROR;

    final public function getCode(): int
    {
        return match ($this) {
            self::SUCCESS        => 200,
            self::SUCCESS_CREATE => 201,
            self::NOT_FOUND      => 404,
            self::SERVER_ERROR   => 500
        };
    }
}
