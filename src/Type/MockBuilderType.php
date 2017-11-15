<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Type;

use Eloquent\Phony\Mock\Builder\MockBuilder;
use PHPStan\Type\ObjectType;

final class MockBuilderType extends ObjectType
{
    public function __construct(string ...$types)
    {
        parent::__construct(MockBuilder::class);

        $this->types = $types;
    }

    public function types(): array
    {
        return $this->types;
    }

    public function describe(): string
    {
        return sprintf(
            '%s<%s>',
            parent::describe(),
            implode('&', $this->types)
        );
    }

    private $types;
}
