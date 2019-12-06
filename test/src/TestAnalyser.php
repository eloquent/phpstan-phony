<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Test;

final class TestAnalyser
{
    public static function analyse(string $path, string $configuration): string
    {
        $root = self::$root = self::$root ?? dirname(dirname(__DIR__));
        self::$arguments = self::$arguments ?? self::escapeArguments(
            "$root/vendor/bin/phpstan",
            'analyse',
            '--level=7',
            '--error-format=test',
            '--no-progress',
            '--configuration'
        );

        $arguments = array_merge(self::$arguments, self::escapeArguments(
            "$root/test/config/$configuration.neon",
            $path
        ));

        exec(implode(' ', $arguments), $output);

        if ($output) {
            return implode("\n", $output) . "\n";
        }

        return '';
    }

    /**
     * @return array<string>
     */
    private static function escapeArguments(string ...$arguments): array
    {
        return array_map('escapeshellarg', $arguments);
    }

    /**
     * @var string
     */
    private static $root;

    /**
     * @var array<string>
     */
    private static $arguments;
}
