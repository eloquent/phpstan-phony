<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use PhpParser\Node\Expr\Array_;
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

        $classes = [];

        if ($arg instanceof Array_) {
            foreach ($arg->items as $item) {
                if ($item->value instanceof ClassConstFetch) {
                    $classes[] = $this->getTypeFromClassConst($item->value, $scope);
                }
            }
        }

        if ($arg instanceof ClassConstFetch) {
            $classes[] = $this->getTypeFromClassConst($arg, $scope);
        }

        $classes = array_unique(array_filter($classes));

        if (!$classes) {
            return $reflection->getReturnType();
        }

        return new InstanceHandleType(...$classes);
    }

    private function getTypeFromClassConst(ClassConstFetch $classConstFetch, Scope $scope): ?string
    {
        $class = $classConstFetch->class;

        if (!$class instanceof Name) {
            return null;
        }

        $class = (string) $class;

        if ('static' === $class) {
            return null;
        }

        if ('self' === $class) {
            $class = $scope->getClassReflection()->getName();
        }

        return $class;
    }

    private $facadeClass;
    private $mockFunction;
    private $partialMockFunction;
}
