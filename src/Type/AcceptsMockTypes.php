<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use RuntimeException;

trait AcceptsMockTypes
{
    /**
     * @return array<string>
     */
    private function getClassListFromMockTypesArg(
        Arg $arg,
        Scope $scope
    ): array {
        $argValue = $arg->value;

        if ($argValue instanceof ClassConstFetch) {
            $class = $this->getClassNameFromConst($argValue, $scope);

            if ($class) {
                return [$class];
            }

            return [];
        }

        if (!$argValue instanceof Array_) {
            return [];
        }

        $classes = [];

        foreach ($argValue->items as $item) {
            $itemValue = $item->value;

            if (!$itemValue instanceof ClassConstFetch) {
                continue;
            }

            if ($class = $this->getClassNameFromConst($itemValue, $scope)) {
                $classes[] = $class;
            }
        }

        return array_unique($classes);
    }

    private function getClassNameFromConst(
        ClassConstFetch $classConst,
        Scope $scope
    ): ?string {
        $class = $classConst->class;

        if (!$class instanceof Name) {
            return null;
        }

        $class = $class->toString();

        if ('static' === $class) {
            return null;
        }

        if ('self' === $class) {
            $classReflection = $scope->getClassReflection();

            if ($classReflection) {
                return $classReflection->getName();
            }

            throw new RuntimeException(
                'Unable to determine the class name of a self:: parameter.'
            );
        }

        return $class;
    }
}
