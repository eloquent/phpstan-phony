<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use PhpParser\Node\Arg;
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
        /** @var Arg[] */
        $args = $call->args;

        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $args,
            $reflection->getVariants()
        );

        return $this->getTypeFromCall($acceptor, $scope, ...$args);
    }

    public function getTypeFromStaticMethodCall(
        MethodReflection $reflection,
        StaticCall $call,
        Scope $scope
    ): Type {
        /** @var Arg[] */
        $args = $call->args;

        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $args,
            $reflection->getVariants()
        );

        return $this->getTypeFromCall($acceptor, $scope, ...$args);
    }

    private function getTypeFromCall(
        ParametersAcceptor $reflection,
        Scope $scope,
        Arg ...$args
    ): Type {
        if (count($args) === 0) {
            return $reflection->getReturnType();
        }

        /** @var array<string> */
        $classes = $this->getClassListFromMockTypesArg($args[0], $scope);

        return new InstanceHandleType(...$classes);
    }

    private $facadeClass;
    private $mockFunction;
    private $partialMockFunction;
}
