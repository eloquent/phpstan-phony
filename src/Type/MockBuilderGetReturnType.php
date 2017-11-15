<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Builder\MockBuilder;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;

final class MockBuilderGetReturnType implements
    DynamicMethodReturnTypeExtension
{
    public static function getClass(): string
    {
        return MockBuilder::class;
    }

    public function isMethodSupported(
        MethodReflection $methodReflection
    ): bool {
        $name = $methodReflection->getName();

        return 'get' === $name ||
            'full' === $name ||
            'partial' === $name ||
            'partialWith' === $name;
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): Type {
        $calledOnType = $scope->getType($methodCall->var);

        if ($calledOnType instanceof MockBuilderType) {
            return TypeFactory::createMockType($calledOnType->types());
        }

        return $methodReflection->getReturnType();
    }
}
