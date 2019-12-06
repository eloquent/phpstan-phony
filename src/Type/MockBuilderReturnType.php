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

final class MockBuilderReturnType implements
    DynamicFunctionReturnTypeExtension,
    DynamicStaticMethodReturnTypeExtension
{
    use AcceptsMockTypes;

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
        $acceptor = ParametersAcceptorSelector::selectFromArgs(
            $scope,
            $call->args,
            $reflection->getVariants()
        );

        return $this->getTypeFromCall($acceptor, $scope, ...$call->args);
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

        return $this->getTypeFromCall($acceptor, $scope, ...$call->args);
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

        return new MockBuilderType(...$classes);
    }

    private $facadeClass;
    private $mockBuilderFunction;
}
