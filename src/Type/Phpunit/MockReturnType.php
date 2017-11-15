<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type\Phpunit;

use Eloquent\Phony\Phpunit\Phony;
use Eloquent\Phpstan\Phony\Type\MockReturnTypeTrait;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;

final class MockReturnType implements DynamicStaticMethodReturnTypeExtension
{
    use MockReturnTypeTrait;

    public static function getClass(): string
    {
        return Phony::class;
    }
}
