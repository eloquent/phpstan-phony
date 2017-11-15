<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\Type;

final class MockBuilderReturnType implements
    DynamicFunctionReturnTypeExtension,
    DynamicStaticMethodReturnTypeExtension
{
    public function __construct(string $namespace)
    {
        $this->facadeClass = "$namespace\Phony";
        $this->mockBuilderFunction = "$namespace\mockBuilder";
    }

    public function getClass(): string
    {
        return $this->facadeClass;
    }

    public function isFunctionSupported(FunctionReflection $reflection): bool
    {
        return $reflection->getName() === $this->mockBuilderFunction;
    }

    public function isStaticMethodSupported(MethodReflection $reflection): bool
    {
        return $reflection->getName() === 'mockBuilder';
    }

    public function getTypeFromFunctionCall(
        FunctionReflection $reflection,
        FuncCall $call,
        Scope $scope
    ): Type {
        return $this->getTypeFromCall($reflection, $call->args, $scope);
    }

    public function getTypeFromStaticMethodCall(
        MethodReflection $reflection,
        StaticCall $call,
        Scope $scope
    ): Type {
        return $this->getTypeFromCall($reflection, $call->args, $scope);
    }

    private function getTypeFromCall(
        ParametersAcceptor $reflection,
        array $args,
        Scope $scope
    ): Type {
        if (count($args) === 0) {
            return $reflection->getReturnType();
        }

        $arg = $args[0]->value;

        if (!$arg instanceof ClassConstFetch) {
            return $reflection->getReturnType();
        }

        $class = $arg->class;

        if (!$class instanceof Name) {
            return $reflection->getReturnType();
        }

        $class = (string) $class;

        if ('static' === $class) {
            return $reflection->getReturnType();
        }

        if ('self' === $class) {
            $class = $scope->getClassReflection()->getName();
        }

        return new MockBuilderType($class);
    }

    private $facadeClass;
    private $mockBuilderFunction;
}
