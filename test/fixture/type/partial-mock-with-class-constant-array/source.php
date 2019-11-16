<?php

declare(strict_types=1);

$mock = Eloquent\Phony\partialMock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\partialMock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\partialMock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);
