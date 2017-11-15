<?php

declare(strict_types=1);

$mock = Eloquent\Phony\Phony::partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\Phony::partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Pho\Phony::partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\Phony::partialMock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);
