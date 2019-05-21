<?php

declare(strict_types=1);

use Eloquent\Phony\Mock\Mock;

function acceptMock(Mock $mock) {}
function acceptIterator(Iterator $iterator) {}

function safeGlob() {
    $result = call_user_func_array('glob', func_get_args());

    if (!$result) {
        throw new RuntimeException('No paths found');
    }

    return $result;
}
