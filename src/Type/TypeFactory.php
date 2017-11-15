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
    public static function createMockType(InstanceHandleType $handle): Type
    {
        return TypeCombinator::intersect(
            ...self::createObjectTypes(Mock::class, ...$handle->types())
        );
    }

    private static function createObjectTypes(string ...$classes): array
    {
        $types = [];

        foreach ($classes as $class) {
            $types[] = new ObjectType($class);
        }

        return $types;
    }
}
