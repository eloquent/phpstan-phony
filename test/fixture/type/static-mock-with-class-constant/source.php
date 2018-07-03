<?php

declare(strict_types=1);

$mock = Eloquent\Phony\Phony::mock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\Phony::mock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\Phony::mock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);
