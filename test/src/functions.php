<?php

declare(strict_types=1);

use Eloquent\Phony\Mock\Mock;

function acceptMock(Mock $mock): void {}

/**
 * @param Iterator<mixed> $iterator
 */
function acceptIterator(Iterator $iterator): void {}

function acceptSerializable(Serializable $serializable): void {}

/**
 * @return array<string>
 */
function safeGlob(): array {
    $result = call_user_func_array('glob', func_get_args());

    if (!$result) {
        throw new RuntimeException('No paths found');
    }

    return $result;
}
