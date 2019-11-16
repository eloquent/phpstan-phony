<?php

declare(strict_types=1);

$mock = Eloquent\Phony\Phony::partialMock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\Phony::partialMock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\Phony::partialMock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);
