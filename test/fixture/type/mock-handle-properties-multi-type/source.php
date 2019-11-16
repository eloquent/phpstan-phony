<?php

declare(strict_types=1);

$handle = Eloquent\Phony\mock([Iterator::class, Serializable::class]);
$handle->current->returns(111);
$handle->serialize->returns('222');
