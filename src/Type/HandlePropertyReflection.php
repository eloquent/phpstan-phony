<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Stub\StubVerifier;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

final class HandlePropertyReflection implements PropertyReflection
{
    public function __construct(ClassReflection $declaringClass)
    {
        $this->declaringClass = $declaringClass;
        $this->type = new ObjectType(StubVerifier::class);
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->declaringClass;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function isReadable(): bool
    {
        return true;
    }

    public function isWritable(): bool
    {
        return false;
    }

    private $declaringClass;
    private $type;
}
