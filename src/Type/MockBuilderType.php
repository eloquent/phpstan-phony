<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Builder\MockBuilder;
use PHPStan\Type\ObjectType;
use PHPStan\Type\VerbosityLevel;

final class MockBuilderType extends ObjectType
{
    public function __construct(string ...$types)
    {
        parent::__construct(MockBuilder::class);

        $this->types = $types;
    }

    /**
     * @return array<string>
     */
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
