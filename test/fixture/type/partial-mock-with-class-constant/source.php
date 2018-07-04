<?php

declare(strict_types=1);

$mock = Eloquent\Phony\partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);
