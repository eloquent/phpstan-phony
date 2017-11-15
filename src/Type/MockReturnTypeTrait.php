<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\Type;

trait MockReturnTypeTrait
{
    public function isStaticMethodSupported(
        MethodReflection $methodReflection
    ): bool {
        return 'mock' === $methodReflection->getName();
    }

    public function getTypeFromStaticMethodCall(
        MethodReflection $methodReflection,
        StaticCall $methodCall,
        Scope $scope
    ): Type {
        if (count($methodCall->args) === 0) {
            return $methodReflection->getReturnType();
        }

        $arg = $methodCall->args[0]->value;

        if (!$arg instanceof ClassConstFetch) {
            return $methodReflection->getReturnType();
        }

        $class = $arg->class;

        if (!$class instanceof Name) {
            return $methodReflection->getReturnType();
        }

        $class = (string) $class;

        if ('static' === $class) {
            return $methodReflection->getReturnType();
        }

        if ('self' === $class) {
            $class = $scope->getClassReflection()->getName();
        }

        return new InstanceHandleType($class);
    }
}
