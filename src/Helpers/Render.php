<?php

declare(strict_types=1);

namespace TRouter\Helpers;

/**
 * Render pages helper
 *
 * @package TRouter\Helpers
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.0
 */
final class Render
{
    /**
     * Default template path
     *
     * @var string
     */
    private const TEMPLATESDIR = __DIR__ . '/../../resources/views/';

    /**
     * Check if template exists
     *
     * @param string $template
     * @return string
     */
    private static function getTemplate(string $template): string
    {
        $template = self::TEMPLATESDIR . $template . '.html';

        return file_exists($template)
            ? file_get_contents($template)
            : file_get_contents(self::TEMPLATESDIR . 'error.html');
    }

    /**
     * Render template path
     *
     * @param string $view
     * @param array $headers
     * @return string
     */
    public static function render(string $view, array $headers = []): string
    {
        $view = self::getTemplate($view);
        return $view;
    }
}
