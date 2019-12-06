<?php

declare(strict_types=1);

namespace Eloquent\Phpstan\Phony\Test;

use PHPStan\Command\AnalysisResult;
use PHPStan\Command\ErrorFormatter\ErrorFormatter as PhpstanErrorFormatter;
use PHPStan\Command\Output;

class TestErrorFormatter implements PhpstanErrorFormatter
{
    public function formatErrors(
        AnalysisResult $analysisResult,
        Output $output
    ): int {
        if (!$analysisResult->hasErrors()) {
            return 0;
        }

        foreach ($analysisResult->getNotFileSpecificErrors() as $notFileSpecificError) {
            $output->writeLineFormatted($notFileSpecificError);
        }

        foreach ($analysisResult->getFileSpecificErrors() as $fileSpecificError) {
            $output->writeLineFormatted($fileSpecificError->getMessage());
        }

        return 1;
    }
}
