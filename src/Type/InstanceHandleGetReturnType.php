<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Handle\InstanceHandle;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;

final class InstanceHandleGetReturnType implements
    DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return InstanceHandle::class;
    }

    public function isMethodSupported(
        MethodReflection $methodReflection
    ): bool {
        return 'get' === $methodReflection->getName();
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): Type {
        $calledOnType = $scope->getType($methodCall->var);

        if ($calledOnType instanceof InstanceHandleType) {
            return TypeFactory::createMockType($calledOnType->types());
        }

        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $methodCall->args,
            $methodReflection->getVariants()
        );

        return $acceptor->getReturnType();
    }
}
