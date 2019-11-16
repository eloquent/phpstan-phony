<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicFunctionReturnTypeExtension;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\Type;

final class MockReturnType implements
    DynamicFunctionReturnTypeExtension,
    DynamicStaticMethodReturnTypeExtension
{
    use AcceptsMockTypes;

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

        $classes = $this->getClassListFromMockTypesArg($args[0], $scope);

        return new InstanceHandleType(...$classes);
    }

    private $facadeClass;
    private $mockFunction;
    private $partialMockFunction;
}
