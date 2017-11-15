<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type\Phpunit;

use Eloquent\Phpstan\Phony\Type\MockBuilderReturnTypeTrait;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;

final class MockBuilderReturnType implements
    DynamicFunctionReturnTypeExtension,
    DynamicStaticMethodReturnTypeExtension
{
    use MockBuilderReturnTypeTrait;

    const PHONY_NAMESPACE = 'Eloquent\Phony\Phpunit';
    const FACADE_CLASS = self::PHONY_NAMESPACE . '\Phony';
    const MOCK_BUILDER_FUNCTION = self::PHONY_NAMESPACE . '\mockBuilder';
}
