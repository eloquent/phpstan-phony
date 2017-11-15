<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type\Standalone;

use Eloquent\Phpstan\Phony\Type\MockReturnTypeTrait;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;

final class MockReturnType implements
    DynamicFunctionReturnTypeExtension,
    DynamicStaticMethodReturnTypeExtension
{
    use MockReturnTypeTrait;

    const PHONY_NAMESPACE = 'Eloquent\Phony';
}
