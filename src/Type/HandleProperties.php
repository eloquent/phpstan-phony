<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Handle\InstanceHandle;
use Eloquent\Phony\Mock\Handle\StaticHandle;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;

final class HandleProperties implements PropertiesClassReflectionExtension
{
    public function hasProperty(ClassReflection $reflection, string $name): bool
    {
        switch ($reflection->getName()) {
            case InstanceHandle::class:
            case StaticHandle::class:
                return true;
        }

        return false;
    }

    public function getProperty(
        ClassReflection $reflection,
        string $name
    ): PropertyReflection {
        return new HandlePropertyReflection($reflection);
    }
}
