<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Builder\MockBuilder;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;

final class MockBuilderGetReturnType implements
    DynamicMethodReturnTypeExtension
{
    public function getClass(): string
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
        MethodCall $call,
        Scope $scope
    ): Type {
        $calledOnType = $scope->getType($call->var);

        if ($calledOnType instanceof MockBuilderType) {
            return TypeFactory::createMockType(...$calledOnType->types());
        }

        /** @var Arg[] */
        $args = $call->args;

        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $args,
            $methodReflection->getVariants()
        );

        return $acceptor->getReturnType();
    }
}
