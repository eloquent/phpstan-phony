<?php

declare(strict_types=1);

$builder = Eloquent\Phony\Phony::mockBuilder([Iterator::class, Serializable::class]);
$get = $builder->get();
acceptIterator($get);
acceptSerializable($get);
acceptMock($get);
$full = $builder->full();
acceptIterator($full);
acceptSerializable($full);
acceptMock($full);
$partial = $builder->partial();
acceptIterator($partial);
acceptSerializable($partial);
acceptMock($partial);
$partialWith = $builder->partialWith();
acceptIterator($partialWith);
acceptSerializable($partialWith);
acceptMock($partialWith);

$builder = Eloquent\Phony\Kahlan\Phony::mockBuilder([Iterator::class, Serializable::class]);
$get = $builder->get();
acceptIterator($get);
acceptSerializable($get);
acceptMock($get);
$full = $builder->full();
acceptIterator($full);
acceptSerializable($full);
acceptMock($full);
$partial = $builder->partial();
acceptIterator($partial);
acceptSerializable($partial);
acceptMock($partial);
$partialWith = $builder->partialWith();
acceptIterator($partialWith);
acceptSerializable($partialWith);
acceptMock($partialWith);

$builder = Eloquent\Phony\Phpunit\Phony::mockBuilder([Iterator::class, Serializable::class]);
$get = $builder->get();
acceptIterator($get);
acceptSerializable($get);
acceptMock($get);
$full = $builder->full();
acceptIterator($full);
acceptSerializable($full);
acceptMock($full);
$partial = $builder->partial();
acceptIterator($partial);
acceptSerializable($partial);
acceptMock($partial);
$partialWith = $builder->partialWith();
acceptIterator($partialWith);
acceptSerializable($partialWith);
acceptMock($partialWith);
