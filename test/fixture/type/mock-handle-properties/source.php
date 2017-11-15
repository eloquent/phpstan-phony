<?php

declare(strict_types=1);

$handle = Eloquent\Phony\mock(Iterator::class);
$handle->current->returns(111);
