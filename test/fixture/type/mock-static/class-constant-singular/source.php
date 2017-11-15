<?php

declare(strict_types=1);

acceptIterator(Eloquent\Phony\mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Phony::mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\partialMock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Phony::partialMock(Iterator::class)->get());

acceptIterator(Eloquent\Phony\Kahlan\mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Kahlan\Phony::mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Kahlan\partialMock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Kahlan\Phony::partialMock(Iterator::class)->get());

acceptIterator(Eloquent\Phony\Pho\mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Pho\Phony::mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Pho\partialMock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Pho\Phony::partialMock(Iterator::class)->get());

acceptIterator(Eloquent\Phony\Phpunit\mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Phpunit\Phony::mock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Phpunit\partialMock(Iterator::class)->get());
acceptIterator(Eloquent\Phony\Phpunit\Phony::partialMock(Iterator::class)->get());
