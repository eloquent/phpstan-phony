<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Mock;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\IntersectionType;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use Traversable;

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

        return new IntersectionType(
            array_merge([$mockType], self::createObjectTypes(...$classes))
        );
    }

    /**
     * @return array<ObjectType>
     */
    private static function createObjectTypes(string ...$classes): array
    {
        $types = [];

        foreach ($classes as $class) {
            if (is_a($class, Traversable::class, true)) {
                $types[] = new GenericObjectType(
                    $class,
                    [new MixedType(), new MixedType()]
                );
            } else {
                $types[] = new ObjectType($class);
            }
        }

        return $types;
    }
}
