<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Handle\InstanceHandle;
use PHPStan\Type\ObjectType;
use PHPStan\Type\VerbosityLevel;

final class InstanceHandleType extends ObjectType
{
    public function __construct(string ...$types)
    {
        parent::__construct(InstanceHandle::class);

        $this->types = $types;
    }

    public function types(): array
    {
        return $this->types;
    }

    public function describe(VerbosityLevel $level): string
    {
        return sprintf(
            '%s<%s>',
            parent::describe($level),
            implode('&', $this->types)
        );
    }

    private $types;
}
