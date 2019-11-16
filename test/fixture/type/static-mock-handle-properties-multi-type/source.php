<?php

declare(strict_types=1);

use Eloquent\Phpstan\Phony\Test\StaticMockHandlePropertiesFixture;

$handle = Eloquent\Phony\onStatic(Eloquent\Phony\mock([DateTime::class, StaticMockHandlePropertiesFixture::class]));
$handle->getLastErrors->returns([]);
$handle->methodA->returns(111);
