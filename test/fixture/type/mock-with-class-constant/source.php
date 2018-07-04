<?php

declare(strict_types=1);

$mock = Eloquent\Phony\mock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\mock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\mock(Iterator::class)->get();
acceptIterator($mock);
acceptMock($mock);
