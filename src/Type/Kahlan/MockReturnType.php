<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type\Kahlan;

use Eloquent\Phony\Kahlan\Phony;
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
