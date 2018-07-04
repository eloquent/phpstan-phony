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
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\Type;
use RuntimeException;

final class MockReturnType implements
    DynamicFunctionReturnTypeExtension,
    DynamicStaticMethodReturnTypeExtension
{
    public function __construct(string $namespace)
    {
        $this->facadeClass = "$namespace\Phony";
        $this->mockFunction = "$namespace\mock";
        $this->partialMockFunction = "$namespace\partialMock";
    }

    public function getClass(): string
    {
        return $this->facadeClass;
    }

    public function isFunctionSupported(FunctionReflection $reflection): bool
    {
        $name = $reflection->getName();

        return $name === $this->mockFunction ||
            $name === $this->partialMockFunction;
    }

    public function isStaticMethodSupported(MethodReflection $reflection): bool
    {
        $name = $reflection->getName();

        return 'mock' === $name || 'partialMock' === $name;
    }

    public function getTypeFromFunctionCall(
        FunctionReflection $reflection,
        FuncCall $call,
        Scope $scope
    ): Type {
        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $call->args,
            $reflection->getVariants()
        );

        return $this->getTypeFromCall($acceptor, $call->args, $scope);
    }

    public function getTypeFromStaticMethodCall(
        MethodReflection $reflection,
        StaticCall $call,
        Scope $scope
    ): Type {
        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $call->args,
            $reflection->getVariants()
        );

        return $this->getTypeFromCall($acceptor, $call->args, $scope);
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
            $classReflection = $scope->getClassReflection();

            if (!$classReflection) {
                throw new RuntimeException(
                    'Unable to determine the class name of a self:: parameter.'
                );
            }

            $class = $classReflection->getName();
        }

        return new InstanceHandleType($class);
    }

    private $facadeClass;
    private $mockFunction;
    private $partialMockFunction;
}
