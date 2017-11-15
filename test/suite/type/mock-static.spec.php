<?php

declare(strict_types=1);

use Eloquent\Phpstan\Phony\Test\TestAnalyser;

describe('Mocking via the static facade', function () {
    $fixturePath = __DIR__ . '/../../fixture/type/mock-static';

    foreach (glob("$fixturePath/*", GLOB_ONLYDIR) as $path) {
        describe(trim(file_get_contents("$path/description")), function () use ($path) {
            it('should produce expected output with vanilla phpstan', function () use ($path) {
                $configuration = 'without';

                expect(TestAnalyser::analyse("$path/source.php", $configuration))
                    ->toBe(file_get_contents("$path/$configuration"));
            });

            it('should produce expected output with phony config included', function () use ($path) {
                $configuration = 'with';

                expect(TestAnalyser::analyse("$path/source.php", $configuration))
                    ->toBe(file_get_contents("$path/$configuration"));
            });
        });
    }
});
