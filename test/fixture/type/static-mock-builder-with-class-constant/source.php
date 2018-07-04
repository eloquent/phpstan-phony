<?php

declare(strict_types=1);

$builder = Eloquent\Phony\Phony::mockBuilder(Iterator::class);
$get = $builder->get();
acceptIterator($get);
acceptMock($get);
$full = $builder->full();
acceptIterator($full);
acceptMock($full);
$partial = $builder->partial();
acceptIterator($partial);
acceptMock($partial);
$partialWith = $builder->partialWith();
acceptIterator($partialWith);
acceptMock($partialWith);

$builder = Eloquent\Phony\Kahlan\Phony::mockBuilder(Iterator::class);
$get = $builder->get();
acceptIterator($get);
acceptMock($get);
$full = $builder->full();
acceptIterator($full);
acceptMock($full);
$partial = $builder->partial();
acceptIterator($partial);
acceptMock($partial);
$partialWith = $builder->partialWith();
acceptIterator($partialWith);
acceptMock($partialWith);

$builder = Eloquent\Phony\Phpunit\Phony::mockBuilder(Iterator::class);
$get = $builder->get();
acceptIterator($get);
acceptMock($get);
$full = $builder->full();
acceptIterator($full);
acceptMock($full);
$partial = $builder->partial();
acceptIterator($partial);
acceptMock($partial);
$partialWith = $builder->partialWith();
acceptIterator($partialWith);
acceptMock($partialWith);
