<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Mock;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

final class TypeFactory
{
    /**
     * Create a PHPStan type from a Phony type specification.
     */
    public static function createMockType(string ...$classes): Type
    {
        $mockType = new ObjectType(Mock::class);

        if (count($classes) < 1) {
            return $mockType;
        }

        return TypeCombinator::intersect(
            $mockType,
            ...self::createObjectTypes(...$classes)
        );
    }

    /**
     * @return array<ObjectType>
     */
    private static function createObjectTypes(string ...$classes): array
    {
        $types = [];

        foreach ($classes as $class) {
            $types[] = new ObjectType($class);
        }

        return $types;
    }
}
