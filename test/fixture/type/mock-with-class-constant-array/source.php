<?php

declare(strict_types=1);

$mock = Eloquent\Phony\mock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Kahlan\mock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);

$mock = Eloquent\Phony\Phpunit\mock([Iterator::class, Serializable::class])->get();
acceptIterator($mock);
acceptSerializable($mock);
acceptMock($mock);
