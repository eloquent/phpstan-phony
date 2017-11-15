<?php

declare(strict_types=1);

$handle = Eloquent\Phony\onStatic(Eloquent\Phony\mock(DateTime::class));
$handle->getLastErrors->returns([]);
